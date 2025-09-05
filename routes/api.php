<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AranzmanController;
use App\Http\Controllers\DestinacijaController;
use App\Http\Controllers\AkcijaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RezervacijaController;

// ===================
// Autentifikacija
// ===================
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// ===================
// Rute za autentifikovane korisnike
// ===================
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('logout', [AuthController::class, 'logout']);

    // Informacije o trenutno ulogovanom korisniku
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // CRUD Aranzmani
    Route::apiResource('aranzmani', AranzmanController::class)->except(['index', 'show']);

    // CRUD Destinacije (samo create/update/delete)
    Route::apiResource('destinacije', DestinacijaController::class)
        ->only(['store', 'update', 'destroy']);

    // CRUD Akcije (bez index)
    Route::apiResource('akcije', AkcijaController::class)->except(['index']);

    // CRUD Rezervacije (samo ulogovani korisnik može da manipuliše sopstvenim rezervacijama)
    Route::apiResource('rezervacije', RezervacijaController::class);
});

// ===================
// Javne rute (dostupne svima)
// ===================

// Aranzmani (samo pregled)
Route::get('aranzmani', [AranzmanController::class, 'index']);
Route::get('aranzmani/{aranzman}', [AranzmanController::class, 'show']);
Route::get('aranzmani/filter', [AranzmanController::class, 'filter']);
Route::get('aranzmani/lastminute', [AranzmanController::class, 'lastMinute']);
Route::get('aranzmani/akcije', [AranzmanController::class, 'withAkcije']);

// Destinacije (samo pregled)
Route::get('destinacije', [DestinacijaController::class, 'index']);

// Akcije (samo pregled)
Route::get('akcije', [AkcijaController::class, 'index']);

// Ping za testiranje API konekcije
Route::get('ping', function () {
    return response()->json(['message' => 'pong']);
});
