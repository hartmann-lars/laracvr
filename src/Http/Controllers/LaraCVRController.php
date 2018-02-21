<?php
namespace Sh4dw\Laracvr\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sh4dw\Laracvr\CVRClient as CVR;

class LaracvrController extends Controller
{
    public function company(int $cvr)
    {
        $data = CVR::request(
            [
                'term' => [
                    'Vrvirksomhed.cvrNummer' =>  $cvr
                ]
            ],
            'POST', //request type
            0, //from
            1 //size
        );
        return $data;
    }

    public function production(int $p)
    {
        $data = CVR::request(
            [
                'term' => [
                    'VrproduktionsEnhed.pNummer' =>  $p
                ]
            ],
            'POST', //request type
            0, //from
            1 //size
        );
        return $data;
    }
}
