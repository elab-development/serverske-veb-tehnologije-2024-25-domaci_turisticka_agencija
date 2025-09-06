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

    // Trenutni korisnik
    Route::get('/user', fn(Request $request) => response()->json($request->user()));

    // Promena lozinke
    Route::post('/user/change-password', [AuthController::class, 'changePassword']);

    // CRUD Aranzmani (bez index/show) + upload + export CSV
    Route::apiResource('aranzmani', AranzmanController::class)->except(['index', 'show']);
    Route::post('aranzmani/upload', [AranzmanController::class, 'upload']); // opcionalno, ako upload posebno
    Route::get('aranzmani/export/csv', [AranzmanController::class, 'exportCsv']);

    // CRUD Destinacije (samo create/update/delete)
    Route::apiResource('destinacije', DestinacijaController::class)
        ->only(['store', 'update', 'destroy']);

    // CRUD Akcije (bez index)
    Route::apiResource('akcije', AkcijaController::class)->except(['index']);

    // CRUD Rezervacije
    Route::apiResource('rezervacije', RezervacijaController::class);
});

// ===================
// Javne rute (samo pregled)
// ===================

// Aranzmani
Route::prefix('aranzmani')->group(function () {
    Route::get('filter', [AranzmanController::class, 'filter']);
    Route::get('lastminute', [AranzmanController::class, 'lastMinute']);
    Route::get('akcije', [AranzmanController::class, 'withAkcije']);
    Route::get('search', [AranzmanController::class, 'search']);
    Route::get('/', [AranzmanController::class, 'index']);
    Route::get('{aranzman}', [AranzmanController::class, 'show'])
        ->where('aranzman', '[0-9]+');
});

// Destinacije
Route::get('destinacije', [DestinacijaController::class, 'index']);
Route::get('destinacije/{id}/weather', [DestinacijaController::class, 'weather']);

// Akcije
Route::get('akcije', [AkcijaController::class, 'index']);

// Ping
Route::get('ping', fn() => response()->json(['message' => 'pong']));
