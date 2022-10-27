<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route for product
// Route::group(['namespace' => 'App\Http\Controllers'], function () {

//     // Route for Guest and Auth
//     Route::group(['middleware' => ['guest', 'auth']], function () {
//         Route::controller(ProductController::class)->group(function () {
//             Route::get('/', 'index');
//             Route::get('/{product}/show', 'show');
//         });
//     });


//     // Guest
//     Route::group(['middleware' => ['guest']], function () {
//         // Route for Guest
//         Route::controller(UserController::class)->group(function () {
//             Route::get('/register', "index");
//             Route::post("/users", "store");
//             Route::get('/login', "login")->name('login');
//             Route::post("/authenticate", "authenticate");
//             Route::get("/verify-account", "verifyAccount")->name('verify_account');
//         });
//     });

//     // Auth
//     Route::group(['middleware' => ['auth']], function () {
//         Route::get('/logout', [UserController::class, "logout"]);

//         Route::group(['prefix' => 'products'], function () {
//             Route::controller(ProductController::class)->group(function () {
//                 Route::post("/", "store");
//                 Route::get('/create', "create");
//                 Route::post("/storeInManage", "storeInManage");
//                 Route::get("/{product}/edit", "edit");
//                 Route::put("/{product}", "update");
//                 Route::get('/{product}/destroy', "showDestroy");
//                 Route::delete("/{product}", "destroy");
//                 Route::get('/import', "showImport");
//                 Route::post('/import', 'import');
//                 Route::get("/manage", "manage");
//                 Route::get('/export', 'export');
//             });
//         });
//     });
// });

Route::get('/', [ProductController::class, "index"]);
Route::get('/products/create', [ProductController::class, "create"])->middleware("auth");
Route::post("/products", [ProductController::class, "store"])->middleware("auth");
Route::post("/products/storeInManage", [ProductController::class, "storeInManage"])->middleware("auth");

Route::get("/products/{product}/edit", [ProductController::class, "edit"])->middleware("auth");
Route::put("/products/{product}", [ProductController::class, "update"])->middleware("auth");
Route::get('/products/{product}/show', [ProductController::class, "show"]);
Route::get('/products/{product}/destroy', [ProductController::class, "showDestroy"])->middleware("auth");
Route::delete("/products/{product}", [ProductController::class, "destroy"])->middleware("auth");
Route::get('/products/import', [ProductController::class, "showImport"]);
Route::post('/products/import', [ProductController::class, 'import'])->middleware("auth");
Route::get("/products/manage", [ProductController::class, "manage"])->middleware("auth");
Route::get('/products/export', [ProductController::class, 'export'])->middleware("auth");

// Route for user
Route::get('/register', [UserController::class, "index"]);
Route::post("/users", [UserController::class, "store"]);
Route::get('/login', [UserController::class, "login"])->name('login')->middleware("guest");
Route::get('/logout', [UserController::class, "logout"])->middleware("auth");
Route::post("/authenticate", [UserController::class, "authenticate"]);
Route::get("/verify-account", [UserController::class, "verifyAccount"])->name('verify_account');
