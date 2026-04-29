<?php

use App\Http\Controllers\AccueilSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignatureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('accueil_session');
    }

    return view('login');
})->name('login');

// API-style login but still using web middleware for session
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/me', [AuthController::class, 'me'])->name('me');

Route::middleware('auth')->group(function () {
    Route::get('/accueil-session', [AccueilSessionController::class, 'getSessions'])
        ->name('accueil_session');

    Route::get('/signature', function () {
        return view('signature');
    })->name('signature');

    Route::post('/signature', [SignatureController::class, 'store'])
        ->name('signatures.post');
});


