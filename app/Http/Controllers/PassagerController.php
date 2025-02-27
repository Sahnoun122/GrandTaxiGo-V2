<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilite;


class PassagerController extends Controller
{

    public function dashboard()
    {
        $disponibilites = Disponibilite::with('chauffeur') 
                                        ->where('statut', 'active') 
                                        ->get();
    
        return view('passager.dashboard', compact('disponibilites')); 
    }
    
}