<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Disponibilite;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    public function trajets()
    {
        $trajets = Trajet::with('disponibilite.chauffeur')->where('id_passager', auth()->id())->get();
        return view('passager.trajets', compact('trajets'));

    }
    

    public function store(Request $request)

    {
        $request->validate([
            'date' => 'required|date',
            'lieu' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'id_dispo' => 'required|exists:disponibilites,id',
        ]);
    
        // Création d'un nouveau trajet
        Trajet::create([
            'date' => $request->date,
            'lieu' => $request->lieu,
            'destination' => $request->destination,
            'id_passager' => auth()->id(), 
            'id_dispo' => $request->id_dispo, 
            'statut' => 'en attente',
        ]);
    
        return redirect()->route('passager.trajets')->with('success', 'Trajet réservé avec succès');
    }

    public function annule($id)
    {
        $trajet = Trajet::find($id);

        if (!$trajet || $trajet->id_passager != auth()->id()) {
            return redirect()->route('passager.trajets')->with('error', 'Trajet non trouvé ou vous n\'êtes pas autorisé à annuler ce trajet.');
        }

        $trajet->statut = 'annule';
        $trajet->save();

        return redirect()->route('passager.trajets')->with('success', 'Trajet annulé avec succès.');
    }
    
}
