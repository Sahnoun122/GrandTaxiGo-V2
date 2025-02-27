<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilite;


class PassagerController extends Controller
{
    public function index()
    {
        $disponibilit = Disponibilite::all();  
    
        return view('chauffeur.index', ['disponibilite' => $disponibilit]);
    }
}