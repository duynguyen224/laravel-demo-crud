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
Route::get('/', [ProductController::class, "index"]);
Route::get('/products/create', [ProductController::class, "create"])->middleware("auth");
Route::post("/products", [ProductController::class, "store"])->middleware("auth");
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
