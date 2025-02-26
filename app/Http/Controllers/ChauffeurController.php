<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChauffeurController extends Controller
{
    public function dashboard()
    {
        return view('chauffeur.dashboard'); 
    }
}
