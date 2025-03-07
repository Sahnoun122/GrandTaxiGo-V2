<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Http\Requests\StorecommentsRequest;
use App\Http\Requests\UpdatecommentsRequest;

use Illuminate\Http\Request;


class CommentsController extends Controller
{


    public function ajouterComment(Request $request, $id)
{
    $request->validate([
        'comment' => 'required|string|max:500',
        'rating' => 'required|integer|between:1,5',
    ]);

    $comment = new Comments();
    $comment->disponibilite_id = $id;
    $comment->user_id = auth()->id();
    $comment->comment = $request->comment;
    $comment->rating = $request->rating;
    $comment->save();

    return redirect()->back()->with('success', 'Commentaire ajouté avec succès !');
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorecommentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecommentsRequest $request, comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('succes', 'comments supprimer');
        
    }
}