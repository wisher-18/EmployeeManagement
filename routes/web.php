<?php

use App\Http\Controllers\employeController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/employes', [employeController::class, 'index'])->name('employe.index');
    Route::get('/employes/create', [employeController::class, 'create'])->name('employe.create');
    Route::post('/employes/store', [employeController::class, 'store'])->name('employe.store');
    Route::get('/user/edit/{id}', [employeController::class, 'edit'])->name('employe.edit');
    Route::post('/user/update/{id}', [employeController::class, 'update'])->name('employe.update');
    Route::delete('/employes/delete/{id}', [employeController::class, 'destroy'])->name('employe.destroy');
   
});