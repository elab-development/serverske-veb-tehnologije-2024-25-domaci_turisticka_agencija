<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkcijaController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('akcije', AkcijaController::class);
});
Route::get('akcije', [AkcijaController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
