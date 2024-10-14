<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\CategoryDeleteResource;
use App\Http\Resources\CategoryListResource;
use App\Http\Resources\CategoryUpdateResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
{
    //category list
    public function list()
    {
        try {
            $categories = Category::all();
            return ResponseHelper::success(CategoryListResource::collection($categories), "success");
        } catch (Exception $err) {
            return ResponseHelper::fail([], $err->getMessage());
        }
    }

    // create category
    public function create(HttpRequest $request)
    {
        // dd($request->header("test"));
        // dd($request->all());

        try {
            $headerData = $request->header("test");
            $category = Category::create([
                "name" => $request->name,
            ]);
            return ResponseHelper::success([$category, "header" => $headerData], "success");
        } catch (\Throwable $th) {
            return ResponseHelper::fail([], $th->getMessage());
        }
    }

    // category delete
    public function destory(HttpRequest $request)
    {
        try {
            $category = Category::findOrFail($request->category_id);
            if (isset($category)) {
                $category->delete();
                return ResponseHelper::success(new CategoryDeleteResource($category), "success");
            } else {
                return ResponseHelper::fail([], "not found category_id ");
            }
        } catch (\Throwable $th) {
            return ResponseHelper::fail([], $th->getMessage());
        }
    }

    // category detail
    public function detail(Category $category)
    {
        if (isset($category)) {
            return response()->json([
                "message" => "success",
                "data" => $category,
            ]);
        } else {
            return response()->json([
                "message" => "category not found!!"
            ]);
        }
    }

    // category update
    public function update(HttpRequest $request)
    {
        try {
            $category = Category::findOrFail($request->category_id);

            if (isset($category)) {
                $category->update([
                    "name" => $request->category_name,
                ]);
                return ResponseHelper::success(new CategoryUpdateResource($category), "success");
            }
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }
}
