<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Destinacija;
use App\Models\Aranzman;
use App\Http\Controllers\AranzmanController;

// Resource rute za Aranzman
Route::apiResource('aranzmani', AranzmanController::class);

// Lista destinacija
Route::get('/destinacije', function () {
    return response()->json(Destinacija::all(), 200);
});

// Filtriranje aranžmana po popustu i destinaciji
Route::get('/aranzmani/filter', function (Request $request) {
    $query = Aranzman::query();

    if ($request->has('destinacija_id')) {
        $query->where('destinacija_id', $request->destinacija_id);
    }

    if ($request->has('popust')) {
        $query->where('popust', '>=', $request->popust);
    }

    return response()->json($query->get(), 200);
});

// Last minute aranžmani
Route::get('/aranzmani/lastminute', function () {
    return response()->json(Aranzman::where('last_minute', true)->get(), 200);
});



