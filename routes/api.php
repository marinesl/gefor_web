<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\CoursController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [ApiAuthController::class, 'logout']);
    Route::get('/auth/me', [ApiAuthController::class, 'me']);
    Route::apiResource('cours', CoursController::class);
});
