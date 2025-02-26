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
        return view('chauffeur.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'dateDebut'=>'required',
            'dateFin'=>'required',
            'destination ' =>'required',
            'statut' =>'required',
            'id_chauffeur' =>'required',
        ]);

        $disponibilite= Disponibilite::create($validateData);
        return redirect('/chauffeur')->with('success' , 'Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
