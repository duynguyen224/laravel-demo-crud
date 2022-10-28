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
Route::group(['namespace' => 'App\Http\Controllers'], function () {

    // Route public
    Route::controller(ProductController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/products/{product}/show', 'show');
    });

    // Guest
    Route::group(['middleware' => ['guest']], function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/register', "index");
            Route::post("/users", "store");
            Route::get('/login', "login")->name('login');
            Route::post("/authenticate", "authenticate");
            Route::get("/verify-account", "verifyAccount")->name('verify_account');
        });
    });

    // Auth
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/logout', [UserController::class, "logout"]);

        Route::group(['prefix' => 'products'], function () {
            Route::controller(ProductController::class)->group(function () {
                Route::post("/", "store");
                Route::get('/create', "create");
                Route::post("/storeInManage", "storeInManage");
                Route::get("/{product}/edit", "edit");
                Route::put("/{product}", "update");
                Route::get('/{product}/destroy', "showDestroy");
                Route::delete("/{product}", "destroy");
                Route::get('/import', "showImport");
                Route::post('/import', 'import');
                Route::get("/manage", "manage");
                Route::get('/export', 'export');
            });
        });
    });
});

