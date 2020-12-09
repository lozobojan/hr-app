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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/employees',  [\App\Http\Controllers\EmployeeController::class, 'index'])->name('employees');
    Route::delete('/employees/delete/{id}', [\App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees/delete');
    Route::get('/employees/{id}', [\App\Http\Controllers\EmployeeController::class, 'getOne'])->name('employee/fetch');
    Route::post('/employees/{object}/edit', [\App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees/edit');
    Route::post('/employees/store', [\App\Http\Controllers\EmployeeController::class, 'store'])->name('employees/store');

        Route::get('/documents', function(){
            return view('documents');
        })->name('documents');

        Route::get('/stats', function(){
            return view('stats');
        })->name('stats');

        // Charts
        Route::get('/tree', function () {
            return view('tree');
        });


        Route::get('/charts', function () {
            return view('charts');
        });

        Route::get('/data',  [\App\Http\Controllers\EmployeeController::class, 'index']);

        Route::get('/tree1', function () {
            return view('tree1');
        });


});

