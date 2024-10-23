<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/admin_view', [AdminController::class, 'index'])->middleware(['auth', 'role:a']);

Route::get('/toggleuserstatus/{id}', [AdminController::class, 'toggleUserStatus'])->name('toggle.userstatus');

Auth::routes();

/** * Email verification routes
 */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

