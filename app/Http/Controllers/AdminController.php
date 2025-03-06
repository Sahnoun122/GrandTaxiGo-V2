<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trajet;
use App\Models\Disponibilite;


class AdminController extends Controller
{

    public function index()
    {
            $users = User::all();
            return view('admin.dashboardAdmin', compact('users'));
  
    }

    public function edit(User $user)
    {
        return view('admin.dashboardAdmin', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('admin.dashboardAdmin')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboardAdmin')->with('success', 'Utilisateur supprimé avec succès');
    }


    public function trajets()
    {
        $trajets = Trajet::all();
        // $user= User::where('Role')
        $revenus = Payments::sum('amount');  
        $trajetsAnnules = Trajet::where('statut', 'annule')->count(); 

        return view('admin.admintrj', compact('trajets', 'revenus', 'trajetsAnnules'));
    }

    public function show(Trajet $trajet)
    {
        return view('admin.admintrj', compact('trajet'));
    }

    public function dispo()
    {
        $disponibilites = Disponibilite::all();
        return view('admin.adminds', compact('disponibilites'));
    }

    // public function update(Request $request, Disponibilite $disponibilite)
    // {
    //     $disponibilite->update($request->all());
    //     return redirect()->route('admin.adminds')->with('success', 'Disponibilité mise à jour');
    // }

}
