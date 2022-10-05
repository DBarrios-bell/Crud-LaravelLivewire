<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;


class ResponseController extends Controller
{

    public function Success($obj, $status){
        return response([
            "ok"=>true,
            "body"=>$obj
        ],$status);
    }

    public function Error($error, $status){
        return response([
            "ok"=>false,
            "error"=>$error
        ],$status);;
    }
}
