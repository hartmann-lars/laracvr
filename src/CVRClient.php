<?php
namespace Sh4dw\Laracvr;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class CVRClient implements CVRClientInterface
{
    public static function request(array $query, string $requestType = 'POST', int $from = 0, int $size = 1)
    {
        //validate query
        if (empty($query)) {
            throw new \InvalidArgumentException('The query is empty');
        }
        //validate request type
        $_requestTypes = ['POST', 'GET'];
        if (!in_array(strtoupper($requestType), $_requestTypes, true)) {
            throw new \InvalidArgumentException('The request type is invalid');
        }
        //validate from (offset)
        if ($from < 0) {
            throw new \InvalidArgumentException('The "from" offset should be unsigned');
        }
        //validate size
        if ($size < 1) {
            throw new \InvalidArgumentException('The "size" should be larger than zero');
        }

        //instantiate a new GuzzleHttp Client with JSON headers
        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        //load a request with authentication from the config file
        $request = $client->request(
            $requestType,
            config('laraCVR.cvr_api_path'),
            [
                'auth' =>  [config('laraCVR.cvr_user'), config('laraCVR.cvr_password')],
                'json' =>
                [
                    'from' => $from,
                    'size' => $size,
                    'query' => $query
                ]
            ]
        );

        // has content and is 200
        if ($request->hasHeader('Content-Length') && $request->getStatusCode() === 200) {
            $response = $request->getBody();
            $content = json_decode($response->getContents());
            $requestDetails = [
                'millis' => $content->took,
                'timedOut' => $content->timed_out,
                'totalHits' => $content->hits->total,
                'data' => null
            ];
            //has hits
            if ($content->hits->total > 0) {
                $extractedResults = [];
                foreach ($content->hits->hits as $hit) {
                    $newEntry = new \stdClass;
                    foreach ($hit->_source as $row) {
                        foreach ($row as $k => $v) {
                            $newEntry->$k = $v;
                        }
                    }
                    array_push($extractedResults, $newEntry);
                }
                $requestDetails['data'] = $extractedResults;
            }
            return $requestDetails;
        } else {
            $errContent = $request->hasHeader('Content-Length') ? 'Had content' : 'Had no content';
            $errHttpCode = $request->getStatusCode();
            throw new \UnexpectedValueException(
                "CVR data request $errContent and failed with HTTP status code: $errHttpCode"
            );
        }
    }
}
