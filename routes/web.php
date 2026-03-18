<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationFinderController;
use App\Http\Controllers\EducationalResourceController;
use App\Http\Controllers\DeviceCreditController;
use App\Http\Controllers\RecyclingHistoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\DeviceCreditsController;

// Authentication Routes
Auth::routes();

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/faq', function () { return view('faq'); })->name('faq');
Route::get('/legal', [HomeController::class, 'legal'])->name('legal');

// Location Finder routes
Route::get('/location-finder', [LocationFinderController::class, 'index'])->name('location-finder');
Route::get('/location-finder/search', [LocationFinderController::class, 'search'])->name('location-finder.search');

// Educational Resources routes
Route::get('/educational-resources', [EducationalResourceController::class, 'index'])->name('educational-resources.index');
Route::get('/educational-resources/{resource}', [EducationalResourceController::class, 'show'])->name('educational-resources.show');
Route::get('/educational-resources/search', [EducationalResourceController::class, 'search'])->name('educational-resources.search');

// Contact Routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Device Credits routes
    Route::get('/device-credits', [DeviceCreditsController::class, 'index'])->name('device-credits.index');
    Route::get('/device-credits/create', [DeviceCreditsController::class, 'create'])->name('device-credits.create');
    Route::post('/device-credits', [DeviceCreditsController::class, 'store'])->name('device-credits.store');
    Route::get('/device-credits/{deviceCredit}', [DeviceCreditsController::class, 'show'])->name('device-credits.show');
    Route::post('/device-credits/{deviceCredit}/redeem', [DeviceCreditsController::class, 'redeem'])->name('device-credits.redeem');

    // Recycling History routes
    Route::get('/recycling-history', [RecyclingHistoryController::class, 'index'])->name('recycling-history.index');
    Route::get('/recycling-history/create', [RecyclingHistoryController::class, 'create'])->name('recycling-history.create');
    Route::post('/recycling-history', [RecyclingHistoryController::class, 'store'])->name('recycling-history.store');
    Route::get('/recycling-history/{history}', [RecyclingHistoryController::class, 'show'])->name('recycling-history.show');

    // Email Verification routes
    Route::get('/email/verify', [EmailVerificationController::class, 'show'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    
    // Password Reset Routes
    Route::get('forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::post('forgot-password/phone', [PasswordResetController::class, 'sendPhoneOTP'])->name('password.phone');
    Route::get('verify-otp', [PasswordResetController::class, 'showVerifyOTPForm'])->name('password.verify.otp');
    Route::post('verify-otp', [PasswordResetController::class, 'verifyOTP'])->name('password.verify.otp.submit');
    Route::post('resend-otp', [PasswordResetController::class, 'resendOTP'])->name('password.resend.otp');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-phone', [LoginController::class, 'showPhoneVerification'])->name('verify.phone');
    Route::post('verify-phone', [LoginController::class, 'verifyPhone']);
    Route::post('resend-otp', [LoginController::class, 'resendOTP'])->name('resend.otp');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
