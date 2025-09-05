<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rezervacija;
use App\Models\Aranzman;

class RezervacijaController extends Controller
{
    // Kreiranje rezervacije
    public function store(Request $request)
    {
        $fields = $request->validate([
            'aranzman_id' => 'required|exists:aranzmani,id',
            'datum_rezervacije' => 'required|date',
            'broj_osoba' => 'required|integer|min:1',
        ]);

        $user = $request->user();
        $aranzman = Aranzman::findOrFail($fields['aranzman_id']);

        $rezervacija = Rezervacija::create([
            'user_id' => $user->id,
            'aranzman_id' => $fields['aranzman_id'],
            'datum_rezervacije' => $fields['datum_rezervacije'],
            'broj_osoba' => $fields['broj_osoba'],
            'ukupna_cena' => $fields['broj_osoba'] * $aranzman->cena,
        ]);

        return response()->json($rezervacija, 201);
    }

    // Prikaz svih rezervacija korisnika
    public function index(Request $request)
    {
        $user = $request->user();
        $rezervacije = $user->rezervacije()->with('aranzman')->get();

        return response()->json($rezervacije);
    }

    // Prikaz jedne rezervacije
    public function show(Request $request, $id)
    {
        $rezervacija = Rezervacija::with('aranzman')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json($rezervacija);
    }

    // Ažuriranje rezervacije
    public function update(Request $request, $id)
    {
        $rezervacija = Rezervacija::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $fields = $request->validate([
            'datum_rezervacije' => 'date',
            'broj_osoba' => 'integer|min:1',
        ]);

        if (isset($fields['broj_osoba'])) {
            $rezervacija->ukupna_cena = $fields['broj_osoba'] * $rezervacija->aranzman->cena;
        }

        $rezervacija->update($fields);

        return response()->json($rezervacija);
    }

    // Brisanje rezervacije
    public function destroy(Request $request, $id)
    {
        $rezervacija = Rezervacija::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $rezervacija->delete();

        return response()->json(['message' => 'Rezervacija uspešno obrisana.']);
    }
}
