<?php

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

Route::get('/', function () {
    return view('products.index');
});

Route::get('/show', function () {
    return view('products.show');
});

Route::get('/create', function () {
    return view('products.create');
});

Route::get('/edit', function () {
    return view('products.edit');
});

Route::get('/register', function () {
    return view('users.register');
});

Route::get('/login', function () {
    return view('users.login');
});
