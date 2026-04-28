<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;

class AccueilSessionController extends Controller
{
    public function getSessions()
    {
        $cours = Cours::with(['user'])
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('heure_debut')
            ->get();

        return view('accueil_session', [
            'cours' => $cours
        ]);
    }
}
