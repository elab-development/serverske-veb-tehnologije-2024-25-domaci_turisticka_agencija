<?php

namespace App\Http\Controllers;

use App\Models\Aranzman;
use Illuminate\Http\Request;
use App\Http\Controllers\AranzmanController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/aranzmani', [AranzmanController::class, 'store']);
    Route::put('/aranzmani/{aranzman}', [AranzmanController::class, 'update']);
    Route::delete('/aranzmani/{aranzman}', [AranzmanController::class, 'destroy']);
});

Route::get('/aranzmani', [AranzmanController::class, 'index']);
Route::get('/aranzmani/{aranzman}', [AranzmanController::class, 'show']);


class AranzmanController extends Controller
{
    public function index()
    {
        return response()->json(Aranzman::with('destinacija')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'naziv_aranzmana' => 'required|string',
            'cena' => 'required|numeric',
            'last_minute' => 'boolean',
            'popust' => 'integer',
            'destinacija_id' => 'required|exists:destinacije,id',
        ]);

        $aranzman = Aranzman::create($validated);
        return response()->json($aranzman, 201);
    }

    public function show(Aranzman $aranzman)
    {
        return response()->json($aranzman->load('destinacija'), 200);
    }

    public function update(Request $request, Aranzman $aranzman)
    {
        $validated = $request->validate([
            'naziv_aranzmana' => 'string',
            'cena' => 'numeric',
            'last_minute' => 'boolean',
            'popust' => 'integer',
            'destinacija_id' => 'exists:destinacije,id',
        ]);

        $aranzman->update($validated);
        return response()->json($aranzman, 200);
    }

    public function destroy(Aranzman $aranzman)
    {
        $aranzman->delete();
        return response()->json(['message' => 'Aranzman obrisan'], 200);
    }
}

