<?php

use App\Http\Controllers\AccueilSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signature', function () {
    return view('signature');
})->name('signature');

Route::get('/accueil-session', [AccueilSessionController::class, 'getSessions'])->name('accueil_session');
