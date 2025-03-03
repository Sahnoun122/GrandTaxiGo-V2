<?php

namespace App\Http\Controllers;
use App\Models\Trajet;

use Illuminate\Http\Request;

class ChauffeurController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth');
    // }

    
    public function index()
    {
        return view('chauffeur.index'); 
    }

       
    // public function trajet()
    // {
    //     $trajets = Trajet::all();  
    //     return view('chauffeur.trajet', compact('trajets'));
    // }
}
