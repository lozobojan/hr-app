<?php

use Barryvdh\DomPDF\Facade as PDF;
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
    return view('auth.login');
});

Auth::routes();



Route::middleware('auth')->group(function () {

    Route::get('/employees',  [\App\Http\Controllers\EmployeeController::class, 'index'])->name('employees');
    Route::delete('/employees/delete/{id}', [\App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees/delete');
    Route::get('/employees/one/{id}', [\App\Http\Controllers\EmployeeController::class, 'getOne'])->name('employee/fetch');
    Route::post('/employees/{object}/edit', [\App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees/edit');
    Route::post('/employees/store', [\App\Http\Controllers\EmployeeController::class, 'store'])->name('employees/store');
    Route::get('/employees/{id}', [\App\Http\Controllers\EmployeeController::class, 'show'])->name('employees/show');
    Route::get('/employees/export/{id}', [\App\Http\Controllers\EmployeeController::class, 'export'])->name('employee.export');
   // Route::get('/pdf/{id}', [\App\Http\Controllers\EmployeeController::class, 'pdf'])->name('employee.pdf');
Route::get('/pdf', function(){
    $pdf = PDF::loadView('employees.pdf');
    // dd($pdf);
    return $pdf->download('employees.pdf');
});
    // -------------------------------------------- Home page ---------------------------------------------------
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // ------------------------------------------- Fajl sistem --------------------------------------------------
    Route::get('/documents', [\App\Http\Controllers\DocumentationController::class, 'index'])->name('documents');

    // ------------------------------------ Organizaciona struktura (drvo) --------------------------------------
    Route::get('/structure', function(){return view('structure');})->name('structure');

    // ------------------------------------------- Statistika ---------------------------------------------------
    Route::get('/statistics', function(){return view('statistics');})->name('statistics');

});

