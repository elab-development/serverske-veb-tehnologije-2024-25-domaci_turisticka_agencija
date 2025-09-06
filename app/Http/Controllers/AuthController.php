<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Registracija korisnika
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'telefon' => 'nullable|string|max:20'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'telefon' => $fields['telefon'] ?? null,
        ]);

        $token = $user->createToken('apitoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    // Login korisnika
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Neispravan email ili lozinka'], 401);
        }

        $token = $user->createToken('apitoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }
    public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:6|confirmed', // potvrda u polju new_password_confirmation
    ]);

    $user = $request->user();

    // Provera trenutne lozinke
    if (!\Hash::check($request->current_password, $user->password)) {
        return response()->json(['message' => 'Trenutna lozinka nije tačna.'], 403);
    }

    // Promena lozinke
    $user->password = \Hash::make($request->new_password);
    $user->save();

    return response()->json(['message' => 'Lozinka uspešno promenjena.']);
}


    // Logout korisnika
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Uspesno ste se odjavili']);
    }
}
