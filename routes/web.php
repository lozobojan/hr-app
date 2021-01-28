<?php

use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\EmployeeController;
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

    Route::get('/employees',  [EmployeeController::class, 'index'])->name('employees');
    Route::delete('/employees/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees/delete');
    Route::get('/employees/one/{id}', [EmployeeController::class, 'getOne'])->name('employee/fetch');
    Route::post('/employees/{object}/edit', [EmployeeController::class, 'edit'])->name('employees/edit');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees/store');
    Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employees/show');
    Route::get('/employees/export/{id}', [EmployeeController::class, 'export'])->name('employee.export');
    Route::get('/employees-export', [EmployeeController::class, 'export_all'])->name('employees.export_all');
    Route::post('/employees/filter', [EmployeeController::class, 'filter'])->name('employees.filter');
   // Route::get('/pdf/{id}', [EmployeeController::class, 'pdf'])->name('employee.pdf');
    Route::get('/pdf/{id}', [EmployeeController::class, 'createPDF']);
    Route::get('/doc/{id}', [EmployeeController::class, 'doc']);
    // -------------------------------------------- Home page ---------------------------------------------------
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // ------------------------------------------- Fajl sistem --------------------------------------------------
    Route::get('/documents', [DocumentationController::class, 'index'])->name('documents');
    Route::get('/document/{id}', [DocumentationController::class, 'getOne'])->name('document/fetch');
    Route::post('/document/edit/{object}', [DocumentationController::class, 'edit'])->name('document/edit');
    Route::get('/directory/{id}', [DocumentationController::class, 'showByDirectory'])->name('directory');
    Route::post('/directory/create', [DocumentationController::class, 'store'])->name('directory/create');
    Route::get('/directory/download/{id}', [DocumentationController::class, 'download'])->name('directory/download');
    Route::get('/directory/delete/{id}', [DocumentationController::class, 'delete']);
    Route::get('/directory/delete-dir/{id}', [DocumentationController::class, 'deleteDirectory']);
    Route::get('/directory/delete-all/{id}', [DocumentationController::class, 'deleteAll']);
    Route::get('/search/{word}', [DocumentationController::class, 'search']);
    Route::get('/tag/sector/{id}', [DocumentationController::class, 'showBySector']);
    Route::get('/tag/type/{id}', [DocumentationController::class, 'showByType']);

    // ------------------------------------ Organizaciona struktura (drvo) --------------------------------------
    Route::get('/structure', function(){return view('structure');})->name('structure');

    // ------------------------------------------- Statistika ---------------------------------------------------
    Route::get('/statistics', [function(){return view('statistics');}])->name('statistics');

});

