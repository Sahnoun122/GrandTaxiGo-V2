<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use Illuminate\Http\Request;

class DisponibiliteController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $disponibilite = Disponibilite::all();  
    
    //     return view('chauffeur.index', ['disponibilite' => $disponibilite]);
    // }

    public function index()
    {
        $disponibilite = Disponibilite::all();  
        
        // dd($disponibilite);

        return view('chauffeur.index', compact('disponibilite'));    
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chauffeur.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add availability.');
        }
    
        $request->validate([
            'date_debut' => 'required|date', // Utilisez les noms de la base de données
            'date_fin' => 'required|date',
            'heure' => 'required|date_format:H:i', // Validation pour le champ heure (format HH:MM)
            'destination' => 'required|string|max:255',
            'statut' => 'required|in:active,desactive',
        ]);
    
        $disponibiliteData = $request->only(['date_debut', 'date_fin', 'heure', 'destination', 'statut']);
        $disponibiliteData['id_chauffeur'] = auth()->user()->id; 
    
        Disponibilite::create($disponibiliteData);
    
        return redirect()->route('chauffeur.index')->with('success', 'Disponibilité ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
          
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $disponibilite = Disponibilite::findOrFail($id);
        return view('chauffeur.edit', compact('disponibilite'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'heure' => 'required|date_format:H:i', // Validation pour le champ heure
            'destination' => 'required|string|max:255',
            'statut' => 'required|in:active,desactive',
        ]);
    
        $disponibilite = Disponibilite::findOrFail($id);
    
        if ($disponibilite->id_chauffeur !== auth()->id()) {
            return redirect()->route('chauffeur.index')->with('error', 'Unauthorized action');
        }
    
        $disponibilite->update($validateData);
    
        return redirect()->route('chauffeur.index')->with('success', 'Disponibilité mise à jour avec succès');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $disponibilite = Disponibilite::findOrFail($id);
        $disponibilite->delete();
        return redirect()->route('chauffeur.index')->with('success' , 'disponibilite supprimer avec succès');
    }
}
