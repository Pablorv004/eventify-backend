<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/admin_view', function () {
//     return view('admin.admin_view');
// })->middleware('auth');

Route::get('/admin/admin_view', [AdminController::class, 'index'])->middleware(['auth', 'role:a']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
