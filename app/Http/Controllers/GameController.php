<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('name')->get();
        return $games;
    }

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'required|string',
        ]);

        $query = $validatedData['search'];

        $games = Game::query()
            ->where('name', 'like', "%{$query}%")
            ->get();

        if ($games->isEmpty()) {
            $message = 'No games found matching your search.';
        } else {
            $message = null;
        }

        return view('searchGames', [
            'games' => $games,
            'message' => $message
        ]);
    }

    public function show($id)
    {
        $reviews = Review::where('game_id', $id)->orderBy('date')->get();
        $users = User::whereIn('id', $reviews->pluck('user_id'))->get();
        $game = Game::findOrFail($id);
        $userReview = Review::where('game_id', $id)->where('user_id', Auth::id())->first();
        return view('game', compact('game', 'reviews', 'users', 'userReview'));
    }

}
