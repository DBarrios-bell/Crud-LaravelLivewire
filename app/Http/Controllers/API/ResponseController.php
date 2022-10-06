<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;


class ResponseController extends Controller
{

    public static function Success($obj, $status){
        return response([
            "ok"=>true,
            "body"=>$obj
        ],$status);
    }

    public static function Error($error, $status){
        return response([
            "ok"=>false,
            "error"=>$error
        ],$status);;
    }
}
