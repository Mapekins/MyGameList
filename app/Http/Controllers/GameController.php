<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Review;
use App\Models\User;

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
            'search' => 'required|string|alpha_dash',
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

        return view('searchgame', [
            'games' => $games,
            'message' => $message
        ]);
    }

    public function show($id)
    {
        $reviews = Review::where('game_id', $id)->orderBy('date')->get();
        $users = User::whereIn('id', $reviews->pluck('user_id'))->get();
        $game = Game::findOrFail($id);
        return view('game', compact('game', 'users', 'reviews'));
    }
}
