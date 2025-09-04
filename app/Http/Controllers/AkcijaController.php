<?php

namespace App\Http\Controllers;

use App\Models\Akcija;
use Illuminate\Http\Request;

class AkcijaController extends Controller
{
    public function index()
    {
        return response()->json(Akcija::with('aranzman')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'naziv' => 'required|string',
            'popust' => 'integer',
            'aranzman_id' => 'required|exists:aranzmani,id',
        ]);

        $akcija = Akcija::create($validated);
        return response()->json($akcija, 201);
    }

    public function show(Akcija $akcija)
    {
        return response()->json($akcija->load('aranzman'), 200);
    }

    public function update(Request $request, Akcija $akcija)
    {
        $validated = $request->validate([
            'naziv' => 'string',
            'popust' => 'integer',
            'aranzman_id' => 'exists:aranzmani,id',
        ]);

        $akcija->update($validated);
        return response()->json($akcija, 200);
    }

    public function destroy(Akcija $akcija)
    {
        $akcija->delete();
        return response()->json(['message' => 'Akcija obrisana'], 200);
    }
}