<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\EventController;


Route::get('/', function () {
    return view('welcome');
});


Route::resource('users', AdminController::class)->middleware(['auth', 'role:a']);
Route::get('/toggleuserstatus/{id}', [AdminController::class, 'toggleUserStatus'])->name('toggle.userstatus')->middleware(['auth', 'role:a']);
Route::get('/toggleuserverified/{id}', [AdminController::class, 'toggleUserVerified'])->name('toggle.userverified')->middleware(['auth', 'role:a']);
Route::get('/deleteuser/{id}', [AdminController::class, 'toggleSoftDelete'])->name('toggle.softdelete')->middleware(['auth', 'role:a']);

Route::resource('events', EventController::class)->middleware(['auth', 'role:o']);

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

Route::get('/deleted', function () {
    return view('auth.deleted');
})->middleware('deleted')->name('deleted.notice');
