<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Disponibilite;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    public function index()
    {
        $trajets = Trajet::with('disponibilite.chauffeur')->where('id_passager', auth()->id())->get();
        return view('passager.trajets', compact('trajets'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'date' => 'required|date',
            'lieu' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'id_dispo' => 'required|exists:disponibilites,id',
        ]);

        Trajet::create([
            'date' => $request->date,
            'lieu' => $request->lieu,
            'destination' => $request->destination,
            'id_passager' => auth()->id(),
            'id_dispo' => $request->id_dispo,
        ]);

        return redirect()->route('passager.index')->with('success', 'Trajet réservé avec succès');
    }
}
