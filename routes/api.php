<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AranzmanController;
use App\Http\Controllers\DestinacijaController;
use App\Http\Controllers\AkcijaController;
use App\Http\Controllers\AuthController;

// ===================
// Auth rute
// ===================

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// ===================
// Zaštićene rute (samo za autentifikovane korisnike)
// ===================
Route::middleware('auth:sanctum')->group(function () {

    
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);

    // CRUD Aranzmani
    Route::apiResource('aranzmani', AranzmanController::class);

    // CRUD Destinacije (samo za create/update/delete)
    Route::apiResource('destinacije', DestinacijaController::class)
        ->only(['store','update','destroy']);

    // CRUD Akcije (bez index, jer je javno)
    Route::apiResource('akcije', AkcijaController::class)
        ->except(['index']);
});

// ===================
// Javne rute (bez autentifikacije)
// ===================

// Aranzmani
Route::get('aranzmani', [AranzmanController::class, 'index']);
Route::get('aranzmani/{aranzman}', [AranzmanController::class, 'show']);
Route::get('aranzmani/filter', [AranzmanController::class, 'filter']);
Route::get('aranzmani/lastminute', [AranzmanController::class, 'lastMinute']);

// Destinacije
Route::get('destinacije', [DestinacijaController::class, 'index']);

// Akcije
Route::get('akcije', [AkcijaController::class, 'index']);

// Informacije o korisniku (samo autentifikovani)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ping', function () {
    return response()->json(['message' => 'pong']);
});
