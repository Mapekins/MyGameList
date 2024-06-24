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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required',
            'user_id' => 'required',
            'text' => 'required',
            'rating' => 'required|integer|min:1|max:10',
        ]);
        $games = Game::all();
        $game = $games->firstWhere('id', $request->game_id);
        $new_review = $game->reviews()->create([
            'game_id' => $request->game_id,
            'user_id' => $request->user_id,
            'text' => $request->text,
            'rating' => $request->rating,
            'date' => now(),
        ]);
        $new_review->save();
        return redirect()->route('game.show', ['id' => $game->id]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'game_id' => 'required',
            'user_id' => 'required',
            'text' => 'required',
            'rating' => 'required|integer|min:1|max:10',
            'date' => now(),
        ]);
        $reviews = Review::all();
        $review = $reviews->where('user_id', $request->user_id)->where('game_id', $request->game_id)->first();
        $review->game_id = $request->game_id;
        $review->user_id = $request->user_id;
        $review->text = $request->text;
        $review->rating = $request->rating;
        $review->save();
        return redirect()->route('game.show', ['id' => $review->game_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'game_id' => 'required',
            'user_id' => 'required',
            'current_user_id' => 'required'
        ]);
        $reviews = Review::all();
        $review = $reviews->where('user_id', $request->user_id)->where('game_id', $request->game_id)->first();
        if($request->current_user_id === $request->user_id){
            $review->delete();
        }
        else{
            $current_user = User::all()->firstWhere('id', $request->current_user_id);
            if($current_user->hasRole(['Admin', 'Moderator'])){
                $review->delete();
            }
            else{
                return redirect()->route('error');
            }
        }
        return redirect()->route('game.show', ['id' => $request->game_id]);
    }
}
