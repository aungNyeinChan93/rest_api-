<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserListResource;
use Exception;
use GuzzleHttp\Psr7\Response;

class UserController extends Controller
{
    // user lists
    public function list()
    {
        try {
            $user = User::get();
            // return response()->json([
            //     "data"=>UserListResource::collection($user)->additional(["message"=>"success"]),
            // ]);
            return ResponseHelper::success(UserListResource::collection($user), "user lists success");
        } catch (Exception $err) {
            return ResponseHelper::fail([], $err->getMessage());
        }
    }   

}
