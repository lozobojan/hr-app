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

Route::get('/data',  [\App\Http\Controllers\EmployeeController::class, 'index']);

Route::get('/tree1', function () {
    return view('tree1');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tree', function () {
    return view('tree');
});


Route::get('/charts', function () {
    return view('charts');
});
