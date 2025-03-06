<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Disponibilite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
class TrajetController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }
  
    public function trajets()
    {
        $trajets = Trajet::all();  
        return view('passager.trajets', compact('trajets'));
    }
    
    
    public function trajet()
    {
        $trajets = Trajet::all();  
        return view('chauffeur.trajet', compact('trajets'));
    }
    

    public function store(Request $request)
    {
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

    public function accept($id)
    {
        $trajet = Trajet::find($id);
    
        if (!$trajet) {
            return redirect()->route('chauffeur.trajet')
                             ->with('error', 'Trajet non trouvé.');
        }
    
        if (!$trajet->disponibilite->chauffeur->id != auth()->id()) {
            return redirect()->route('chauffeur.trajet')->with('error', 'Vous n\'êtes pas autorisé à accepter ce trajet.');
        }
    
        $trajet->statut = 'accepte';
        $trajet->save();
    
        try {
            Mail::to($trajet->passager->email)->send(new Email($trajet));
        } catch (\Exception $e) {
            // dd($e);
            // \Log::error('Échec de l\'envoi de l\'email : ' . $e->getMessage());
            return redirect()->route('chauffeur.trajet')
                             ->with('error', 'Trajet accepté, mais échec de l\'envoi de l\'email.');
        }
    
        return redirect()->route('chauffeur.trajet')
                         ->with('success', 'Trajet accepté avec succès. Email envoyé au passager.');
    }
    


    public function refuse($id)
    {
        $trajet = Trajet::find($id);

        if (!$trajet || $trajet->disponibilite->chauffeur->id != auth()->id()) {
            return redirect()->route('chauffeur.trajets')->with('error', 'Trajet non trouvé ou vous n\'êtes pas autorisé à refuser ce trajet.');
        }

        $trajet->statut = 'refuse';
        $trajet->save();

        return redirect()->route('chauffeur.trajet')->with('success', 'Trajet refusé avec succès.');
    }
    
}