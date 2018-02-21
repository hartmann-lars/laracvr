<?php
namespace Sh4dw\Laracvr\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sh4dw\Laracvr\CVRClient as CVR;

class LaracvrController extends Controller
{
    public function show(int $cvr)
    {
        $data = CVR::request(
            [
                'term' => [
                    'cvrNummer' =>  $cvr
                ]
            ],
            'POST', //request type
            0, //from
            1 //size
        );
        return $data;
    }
}
