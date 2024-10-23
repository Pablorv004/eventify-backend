<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\VerificationController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/admin_view', [AdminController::class, 'index'])->middleware(['auth', 'role:a']);

Route::get('/toggleuserstatus/{id}', [AdminController::class, 'toggleUserStatus'])->name('toggle.userstatus');

Auth::routes();

/** * Email verification routes
 */
Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified', 'activated'])
    ->name('home');

Route::get('/waitforauth', function () {
    return view('auth.waitforactivation');
})->middleware(['auth', 'verified'])->name('activation.notice');
