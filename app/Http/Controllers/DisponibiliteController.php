<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use Illuminate\Http\Request;

class DisponibiliteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disponibilite = Disponibilite::all();  
    
        return view('chauffeur.index', ['disponibilite' => $disponibilite]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chauffeur.show');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dateDebut' => 'required',
            'dateFin' => 'required',
            'destination' => 'required',
            'statut' => 'required',
            'id_chauffeur'
        ]);
    
        $disponibiliteData = $request->all();
        $disponibiliteData['id_chauffeur'] = auth()->user()->id; 

        Disponibilite::create($disponibiliteData);
    
        return redirect()->route('chauffeur.index')->with('success', 'Disponibilite ajoutée avec succès');
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
        $disponibilite= Disponibilite::findOrFail($id);
        return view ('chauffeur.edit' , compact('disponibilite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData= $request->validate([
            'dateDebut'=>'required',
            'dateFin'=>'required',
            'destination ' =>'required',
            'statut' =>'required',

        ]);
        Disponibilite::whereId($id)->update($validateData);
        return redirect()->route('chauffeur.index')->with('success' , 'disponibilite mise à jour avec succès');
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
