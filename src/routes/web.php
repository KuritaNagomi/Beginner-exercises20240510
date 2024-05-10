<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\UserController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])->middleware(['auth'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/punchin', [AttendanceController::class, 'punchIn']);
    Route::post('/punchout', [AttendanceController::class, 'punchOut']);
    Route::post('/reststart', [RestController::class, 'restStart']);
    Route::post('/restend', [RestController::class, 'restEnd']);
    Route::get('/date', [DateController::class, 'index'])->name('date.index');
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/users_record/{id}', [UserController::class, 'record'])->name('user.record');
});
