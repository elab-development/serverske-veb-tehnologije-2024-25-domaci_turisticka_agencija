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

    // Promena lozinke
    Route::post('/user/change-password', [AuthController::class, 'changePassword']);

    // CRUD Aranzmani (bez index/show)
    Route::apiResource('aranzmani', AranzmanController::class)->except(['index', 'show']);

    // CRUD Destinacije (samo create/update/delete)
    Route::apiResource('destinacije', DestinacijaController::class)
        ->only(['store', 'update', 'destroy']);

    // CRUD Akcije (bez index)
    Route::apiResource('akcije', AkcijaController::class)->except(['index']);

    // CRUD Rezervacije (samo ulogovani korisnik)
    Route::apiResource('rezervacije', RezervacijaController::class);
});

// ===================
// Javne rute (samo pregled)
// ===================

// Aranzmani
Route::prefix('aranzmani')->group(function () {
    Route::get('filter', [AranzmanController::class, 'filter']);          // filtriranje
    Route::get('lastminute', [AranzmanController::class, 'lastMinute']);  // last minute aranžmani
    Route::get('akcije', [AranzmanController::class, 'withAkcije']);      // aranžmani sa akcijama
    Route::get('search', [AranzmanController::class, 'search']);          // pretraga po nazivu i destinaciji

    // Standardne GET rute
    Route::get('/', [AranzmanController::class, 'index']);                // svi aranžmani (paginacija)
    Route::get('{aranzman}', [AranzmanController::class, 'show'])
        ->where('aranzman', '[0-9]+');                                   // samo numerički ID prolazi
});

// Destinacije
Route::get('destinacije', [DestinacijaController::class, 'index']);       // pregled svih destinacija
Route::get('destinacije/{id}/weather', [DestinacijaController::class, 'weather']); // weather za destinaciju

// Akcije
Route::get('akcije', [AkcijaController::class, 'index']);                 // pregled svih akcija

// Ping za testiranje API konekcije
Route::get('ping', function () {
    return response()->json(['message' => 'pong']);
});
