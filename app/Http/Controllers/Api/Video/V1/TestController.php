<?php

namespace App\Http\Controllers\Api\Video\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class TestController extends BaseController
{
    public function phone(Request $request)
    {
        $row = DB::table('Test')->where('ID', $request->ID)->first();
        if ($row && $row->Num > 0) {
            $num = $row->Num - 1;
            $res = DB::update('update Test set Num = ' . $num . ' where ID = ' . $row->ID . ';');
            if ($res) {
                return Response::json(array(
                    'Code' => 200,
                    'Status' => 'SUCCESS',
                    'Message' => $res ? '' : 'empty'
                ));
            }
        }
        return Response::json(array(
            'Code' => 200,
            'Status' => 'SUCCESS',
            'Message' => 'empty'
        ));
    }
}
