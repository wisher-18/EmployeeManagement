<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/user/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/user/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employees/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employee.show');
   
});