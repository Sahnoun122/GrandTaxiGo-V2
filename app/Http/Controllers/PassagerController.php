<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassagerController extends Controller
{
    public function dashboard()
    {
        return view('passager.dashboard'); 
    }
}