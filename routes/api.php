<?php

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("test",function(){
    $data = [
        "name"=>"chan",
        "age"=>20,
        "gender"=>"male",
    ];
    // return response()->json(["data"=>$data  ],200);
    return ResponseHelper::success($data,"test-api success");
});

// user
Route::get("users",[UserController::class,"list"]);

// category
Route::get("category",[CategoryController::class,"list"]);
Route::post("category",[CategoryController::class, "create"]);
Route::delete("category",[CategoryController::class, "destory"]);
Route::get("category/{category}",[CategoryController::class, "detail"]);
Route::put("category",[CategoryController::class, "update"]);

// contact
Route::get("contacts",[ContactController::class,"list"]);
Route::post("contacts",[ContactController::class,"create"]);
Route::delete("contacts",[ContactController::class,"delete"]);
Route::post("contacts/detail",[ContactController::class,"detail"]);
Route::put("contacts",[ContactController::class,"edit"]);


// 
