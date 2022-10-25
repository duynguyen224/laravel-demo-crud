<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', function () {
    $categories = DB::table("categories")->get();
    return $categories;
});

Route::post("/products/delete-list-products", function (Request $request) {
    $itemIds = $request->get('listId');

    foreach ($itemIds as $id) {
        DB::table("products")->where("id", "=", $id)->delete();
    }

    $msg = "Delete success " . count($itemIds) . " products";

    return response()->json($msg);
});
