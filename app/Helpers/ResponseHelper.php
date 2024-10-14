<?php

namespace App\Helpers;

class ResponseHelper {
    public static function success($data = [], $message = "success"){
        return response()->json([
            "message" => $message,
            "data" =>$data
        ],200);
    }

    public static function fail($data = [], $message = "fail"){
        return response()->json([
            "message" => $message,
            "data" =>$data
        ],400);
    }
}
