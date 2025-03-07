<?php

namespace App\Http\Controllers;
use App\Models\CommentReponde;
use Illuminate\Http\Request;
use App\Models\comments;
use Illuminate\View\View;

class CommentRepondec extends Controller
{


//     public function showw()
// {
//     $comments = comments::with('passager.comments')->get();
//     return view('chauffeur.comments', compact('comments'));
// }

public function showw()
{
    $comments = comments::all();
    return view('chauffeur.comments', compact('comments'));
}

    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'reponde' => 'required|string|max:500',
        ]);

        CommentReponde::create([
            'comment_id' => $request->comment_id,
            'chauffeur_id' => auth()->id(), 
            'reponde' => $request->reply,
        ]);
        return redirect()->back()->with('success', 'Réponse enregistrée avec succès !');
    }
}
