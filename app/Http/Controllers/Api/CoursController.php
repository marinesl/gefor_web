<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cours;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->role === 'formateur') {
            $cours = Cours::with(['user'])
                ->whereDate('date', '>=', now()->toDateString())
                ->where('user_id', $user->id)
                ->whereDoesntHave('signatures', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orderBy('date')
                ->orderBy('heure_debut')
                ->get();
        } elseif ($user->role === 'apprenant') {
            $cours = Cours::with(['user'])
                ->whereDate('date', '>=', now()->toDateString())
                ->where('classe_id', $user->classe_id)
                ->whereDoesntHave('signatures', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orderBy('date')
                ->orderBy('heure_debut')
                ->get();
        } else {
            $cours = Cours::with(['user'])
                ->whereDate('date', '>=', now()->toDateString())
                ->orderBy('date')
                ->orderBy('heure_debut')
                ->get();
        }

        return response()->json($cours);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matiere' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date_format:Y-m-d'],
            'heure_debut' => ['required', 'date_format:H:i'],
            'heure_fin' => ['required', 'date_format:H:i'],
            'salle' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $cours = Cours::create($validated);

        return response()->json($cours, 201);
    }

    /**
     * Display the specified resource (with id)
     */
    public function show(int $id)
    {
        $cours = Cours::find($id)->load(['user']);

        return response()->json($cours);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cours $cours)
    {
        $validated = $request->validate([
            'matiere' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date_format:Y-m-d'],
            'heure_debut' => ['required', 'date_format:H:i'],
            'heure_fin' => ['required', 'date_format:H:i'],
            'salle' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $cours->update($validated);

        return response()->json($cours);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cours)
    {
        $cours->delete();

        return response()->json([
            'message' => 'Cours supprimé'
        ]);
    }
}
