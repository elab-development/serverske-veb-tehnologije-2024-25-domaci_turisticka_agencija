<?php

namespace App\Http\Controllers;

use App\Models\Aranzman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AranzmanController extends Controller
{
 public function index(Request $request)
{
    $aranzmani = Aranzman::paginate(5);

        return response()->json($aranzmani);
}


    public function store(Request $request)
    {
      $validated = $request->validate([
        'naziv' => 'required|string|max:255',
        'opis' => 'nullable|string',
        'cena' => 'required|numeric',
        'popust' => 'nullable|numeric',
        'pocetak' => 'required|date',
        'kraj' => 'required|date',
        'broj_mesta' => 'required|integer',
        'destinacija_id' => 'required|exists:destinacije,id',
        'slika' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validacija fajla
    ]);

    if ($request->hasFile('slika')) {
        $path = $request->file('slika')->store('aranzmani', 'public');
        $validated['slika'] = $path;
    }

    $aranzman = Aranzman::create($validated);
    return response()->json($aranzman, 201);
    }

    public function show(Aranzman $aranzman)
    {
        return response()->json($aranzman->load('destinacija'), 200);
    }

     public function search(Request $request)
    {
        $query = Aranzman::with('destinacija');

        if ($request->has('naziv')) {
            $query->where('naziv', 'like', '%' . $request->naziv . '%');
        }

        if ($request->has('destinacija')) {
            $query->whereHas('destinacija', function ($q) use ($request) {
                $q->where('naziv', 'like', '%' . $request->destinacija . '%');
            });
        }

        return response()->json($query->get());
    }

public function exportCsv()
{
    $aranzmani = Aranzman::all();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="aranzmani.csv"',
    ];

    $callback = function() use ($aranzmani) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['ID', 'Naziv', 'Opis', 'Cena', 'Popust', 'Pocetak', 'Kraj', 'Broj mesta', 'Destinacija']);
        foreach ($aranzmani as $a) {
            fputcsv($file, [
                $a->id,
                $a->naziv,
                $a->opis,
                $a->cena,
                $a->popust,
                $a->pocetak,
                $a->kraj,
                $a->broj_mesta,
                $a->destinacija_id,
            ]);
        }
        fclose($file);
    };

    return Response::stream($callback, 200, $headers);
}

public function filter(Request $request)
{
    $query = Aranzman::query();

    if ($request->has('cena_min')) {
        $query->where('cena', '>=', $request->cena_min);
    }

    if ($request->has('cena_max')) {
        $query->where('cena', '<=', $request->cena_max);
    }

    if ($request->has('destinacija_id')) {
        $query->where('destinacija_id', $request->destinacija_id);
    }

    $aranzmani = $query->with('destinacija')->get();

    return response()->json($aranzmani, 200);
}
public function lastMinute()
{
    // Pretpostavimo da je last minute definisan kao popust >= 20%
    $aranzmani = Aranzman::where('popust', '>=', 20)
        ->with('destinacija')
        ->get();

    return response()->json($aranzmani, 200);
}
public function withAkcije()
{
    $aranzmani = Aranzman::whereHas('akcije')
        ->with(['destinacija', 'akcije'])
        ->get();

    return response()->json($aranzmani, 200);
}


    public function update(Request $request, Aranzman $aranzman)
    {
        $validated = $request->validate([
                'naziv' => 'required|string',
        'opis' => 'nullable|string',
        'cena' => 'required|numeric',
        'popust' => 'nullable|numeric',
        'pocetak' => 'required|date',
        'kraj' => 'required|date|after_or_equal:pocetak',
        'broj_mesta' => 'required|integer|min:1',
        'destinacija_id' => 'required|exists:destinacijas,id',
        'last_minute' => 'nullable|boolean',
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
