<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignatureController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'signature' => ['required', 'string'], // base64 data URL
            'cours_id'  => ['required', 'integer'],
        ]);

        Signature::create([
            'signature' => $validated['signature'],       // full data URL (base64)
            'date'      => now(),
            'user_id'   => Auth::id(),
            'cours_id'  => $validated['cours_id'],
        ]);

        return redirect()
            ->route('accueil_session')
            ->with('status', 'Signature enregistrée !');
    }
}
