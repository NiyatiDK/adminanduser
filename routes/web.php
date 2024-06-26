<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

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

Route::post('admin/Register',[AdminController::class,'register'])->name('register');

Route::post('admin/login',[AdminController::class,'admin_login'])->name('login');

Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');

Route::get('user/add',[AdminController::class,'add_user'])->name('add_user');
Route::Post('/getcity', [AdminController::class, 'getAllcity']);
