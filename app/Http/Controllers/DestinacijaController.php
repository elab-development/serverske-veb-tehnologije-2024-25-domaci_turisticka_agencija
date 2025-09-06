<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinacija;
use Illuminate\Support\Facades\Http;

class DestinacijaController extends Controller
{
    // ===========================
    // JAVNE RUTE
    // ===========================

    // Prikaz svih destinacija
    public function index()
    {
        return response()->json(Destinacija::all());
    }

    // Prikaz jedne destinacije
    public function show($id)
    {
        $destinacija = Destinacija::findOrFail($id);
        return response()->json($destinacija);
    }

    // Vremenska prognoza za destinaciju
    public function weather($id)
    {
        $destinacija = Destinacija::findOrFail($id);

        $city = $destinacija->naziv;
        $apiKey = env('OPENWEATHER_API_KEY');

        // Ako nema API ključa u .env fajlu
        if (!$apiKey) {
            return response()->json(['message' => 'API ključ nije podešen'], 500);
        }

        $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }

        return response()->json(['message' => 'Ne mogu dohvatiti podatke o vremenu'], 500);
    }

    // ===========================
    // RUTE ZA AUTENTIFIKOVANE
    // ===========================

    // Kreiranje nove destinacije
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naziv' => 'required|string|max:255',
            'drzava' => 'required|string|max:255',
            'opis'   => 'nullable|string',
        ]);

        $destinacija = Destinacija::create($validated);

        return response()->json([
            'message' => 'Destinacija uspešno kreirana',
            'destinacija' => $destinacija
        ], 201);
    }

    // Ažuriranje destinacije
    public function update(Request $request, $id)
    {
        $destinacija = Destinacija::findOrFail($id);

        $validated = $request->validate([
            'naziv' => 'sometimes|required|string|max:255',
            'drzava' => 'sometimes|required|string|max:255',
            'opis'   => 'nullable|string',
        ]);

        $destinacija->update($validated);

        return response()->json([
            'message' => 'Destinacija uspešno ažurirana',
            'destinacija' => $destinacija
        ]);
    }

    // Brisanje destinacije
    public function destroy($id)
    {
        $destinacija = Destinacija::findOrFail($id);
        $destinacija->delete();

        return response()->json([
            'message' => 'Destinacija uspešno obrisana'
        ]);
    }
}
