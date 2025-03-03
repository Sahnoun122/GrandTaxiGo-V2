<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilite;


class PassagerController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function dashboard(Request $request)
    {
        if ($request->has('search') && !empty($request->search)) {
            $disponibilites = Disponibilite::with('chauffeur')
                                            ->where('statut', 'active')
                                            ->where('destination', 'like', '%' . $request->search . '%') // Recherche par destination
                                            ->get();
        } else {
            $disponibilites = Disponibilite::with('chauffeur')
                                            ->where('statut', 'active')
                                            ->get();
        }
    
        return view('passager.dashboard', compact('disponibilites'));
    }
    
    
}