<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:passager,chauffeur,admin', // Validate against specific values
            'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('photos')) {
            $path = $request->file('photos')->store('photos', 'public');
        } else {
            $path = null;
        }
    
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'Role' => $request->role,
            'photos' => $path,
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        if ($user->Role === 'chauffeur') {
            return redirect()->route('chauffeur.index');
        } elseif ($user->Role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('passager.dashboard');
        }
    }
}

