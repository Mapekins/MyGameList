<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all()->sortByDesc('date');
        $games = Game::all();
        $users = User::all();
        return view('review.index', compact('reviews', 'games', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check()) {abort(403);}
        $games = Game::all();
        $users = User::all();
        return view('review.create', compact('games', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'game' => 'required',
            'user' => 'required',
            'text' => 'required',
            'rating' => 'required',
        ]);
        $game = Game::findOrFail($request->game_id);
        $new_review = $game->reviews()->create(
            [
                'game' => $request->game_id,
                'user' => $request->user_id,
                'text' => $request->text,
                'rating' => $request->rating
            ]
        );
        $new_review->save();
        return redirect()->route('review.show', $new_review->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::find($id);
        return view('review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::find($id);
        if (! Gate::allows('edit-review', $review)) {abort(403);}
        $games = Game::all();
        $users = User::all();
        return view('review.edit', compact('review', 'games', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        if ($request->game_id == null || $request->user_id == null || $request->text == null || $request->rating == null) {
            return redirect()->route('posts.edit', $id);
        }
        //all clear - updating the post!
        $review = Review::find($id);
        if (! Gate::allows('update-review', $review)) {abort(403);}
        $review->game_id = $request->game_id;
        $review->user_id = $request->user_id;
        $review->text = $request->text;
        $review->rating = $request->rating;
        $review->save();
        return redirect()->route('review.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::find($id);
        if (! Gate::allows('destroy-review', $review)) {abort(403);}
        Review::findOrfail($id)->delete();
        return redirect()->route('review.index');
    }
}
