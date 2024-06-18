<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

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
        $game = Game::findOrFail($id);
        return view('game', compact('game'));
    }
}
