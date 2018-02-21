<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Sh4dw\Laracvr\CVRClient;

class CvrUnitTest extends TestCase
{
    //variables
    protected $validCvrLookupQuery = [
        'term' => [
            'Vrvirksomhed.cvrNummer' =>  37361798
        ]
    ];
    protected $emptyCvrLookupQuery = [
        'term' => [
            'cvrNummer' =>  -1
        ]
    ];

    /**
     * Some of the arguments are not passed
     * @return expectException ArgumentCountError
     */
    public function testMissingParams()
    {
        $this->expectException('ArgumentCountError');

        CVRClient::request();
    }
    /**
     * The query type is invalid
     * @return expectException InvalidArgumentException
     */
    public function testInvalidRequestType()
    {
        $this->expectException('InvalidArgumentException');

        $request = 'FOO';

        CVRClient::request(
            $this->validCvrLookupQuery,
            $request, //request type
            0, //from
            1 //size
        );
    }
    /**
     * The query is empty
     * @return expectException InvalidArgumentException
     */
    public function testInvalidEmptyQuery()
    {
        $this->expectException('InvalidArgumentException');

        $emptyQuery = [];

        CVRClient::request(
            $emptyQuery,
            'POST', //request type
            0, //from
            1 //size
        );
    }
    /**
     * The from parameter is faulty (negative)
     * @return expectException InvalidArgumentException
     */
    public function testInvalidFromRange()
    {
        $this->expectException('InvalidArgumentException');
        CVRClient::request(
            $this->validCvrLookupQuery,
            'POST', //request type
            -1, //from
            1 //size
        );
    }
    /**
     * The size parameter is invalid
     * @return expectException InvalidArgumentException
     */
    public function testInvalidSize()
    {
        $this->expectException('InvalidArgumentException');
        CVRClient::request(
            $this->validCvrLookupQuery,
            'POST', //request type
            0, //from
            0 //size
        );
    }
    /**
     * A valid sample request
     * @return assertNotEmpty response
     */
    public function testRequest()
    {
        $response = CVRClient::request($this->validCvrLookupQuery);

        $this->assertNotEmpty($response);
    }
    /**
     * The request found no results
     * @return assertTrue totalHits and assertNull data
     */
    public function testEmptyRequestResult()
    {
        $response = CVRClient::request(
            $this->emptyCvrLookupQuery,
            'POST', //request type
            0, //from
            1 //size
        );
        //no hits
        $this->assertTrue($response['totalHits'] === 0);
        //data is null
        $this->assertNull($response['data']);
    }
    /**
     * An invalid hostname was set
     * @return expectException GuzzleHttp\Exception\ConnectException
     */
    public function testInvalidHostnameRequest()
    {
        $this->expectException('GuzzleHttp\Exception\ConnectException');

        //invalidate the hostname
        config(['laracvr.cvr_api_path' => 'x']);

        CVRClient::request(
            $this->validCvrLookupQuery,
            'POST', //request type
            0, //from
            1 //size
        );
    }
    /**
     * Invalid username was given
     * @return expectException GuzzleHttp\Exception\ClientException
     */
    public function testInvalidCredentials()
    {
        $this->expectException('GuzzleHttp\Exception\ClientException');
        config(['laracvr.cvr_user' => 'foo']);

        CVRClient::request(
            $this->validCvrLookupQuery,
            'POST', //request type
            0, //from
            1 //size
        );
    }

    //@todo: test when no headers in response
}
