<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinacija;

class DestinacijaController extends Controller
{
    // Prikaz svih destinacija (javna ruta)
    public function index()
    {
        $destinacije = Destinacija::all();
        return response()->json($destinacije);
    }

    // Kreiranje nove destinacije (autentifikovani korisnici)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naziv' => 'required|string|max:255',
            'drzava' => 'required|string|max:255',
            'opis' => 'nullable|string',
        ]);

        $destinacija = Destinacija::create($validated);

        return response()->json([
            'message' => 'Destinacija uspešno kreirana',
            'destinacija' => $destinacija
        ], 201);
    }

    // Prikaz jedne destinacije (opcionalno, može se koristiti u javnim rutama)
    public function show($id)
    {
        $destinacija = Destinacija::findOrFail($id);
        return response()->json($destinacija);
    }

    // Ažuriranje destinacije (autentifikovani korisnici)
    public function update(Request $request, $id)
    {
        $destinacija = Destinacija::findOrFail($id);

        $validated = $request->validate([
            'naziv' => 'sometimes|required|string|max:255',
            'drzava' => 'sometimes|required|string|max:255',
            'opis' => 'nullable|string',
        ]);

        $destinacija->update($validated);

        return response()->json([
            'message' => 'Destinacija uspešno ažurirana',
            'destinacija' => $destinacija
        ]);
    }

    // Brisanje destinacije (autentifikovani korisnici)
    public function destroy($id)
    {
        $destinacija = Destinacija::findOrFail($id);
        $destinacija->delete();

        return response()->json([
            'message' => 'Destinacija uspešno obrisana'
        ]);
    }
}
