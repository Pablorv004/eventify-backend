<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\VerificationController;


Route::get('/', function () {
    return view('welcome');
});

// ADMIN ROUTES
Route::resource('admin', AdminController::class)->middleware(['auth', 'role:a']);
Route::get('/toggleuserstatus/{id}', [AdminController::class, 'toggleUserStatus'])->name('toggle.userstatus')->middleware(['auth', 'role:a']);
Route::get('/toggleuserverified/{id}', [AdminController::class, 'toggleUserVerified'])->name('toggle.userverified')->middleware(['auth', 'role:a']);
Route::get('/deleteuser/{id}', [AdminController::class, 'toggleSoftDelete'])->name('toggle.softdelete')->middleware(['auth', 'role:a']);


// ORGANIZER ROUTES
Route::resource('events', EventController::class)->middleware(['auth', 'role:o', 'activated']);

// USER ROUTES
Route::resource('user', UserController::class)->middleware(['auth', 'activated', 'role:u']);
Route::post('/user/register-event/{event}', [UserController::class, 'registerEvent'])->name('user.registerEvent')->middleware(['auth', 'activated', 'role:u']);
Route::post('/user/unregister-event/{event}', [UserController::class, 'unregisterEvent'])->name('user.unregisterEvent')->middleware(['auth', 'activated', 'role:u']);

// REPORT ROUTES
Route::resource('report', ReportController::class)->middleware(['auth', 'activated', 'role:u']);
Route::post('/report/send-email', [ReportController::class, 'sendEmail'])->name('report.sendEmail')->middleware(['auth', 'activated', 'role:u']);

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
