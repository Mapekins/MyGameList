<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GameList;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GameListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $status = $request->query('status');
        $gameListQuery = GameList::where('user_id', $user->id)->with('game');

        if ($status !== null && in_array($status, [1, 2, 3, 4, 5])) {
            $gameListQuery->where('status', $status);
        }

        if ($request->query('favorite')) {
            $gameListQuery->where('favorite', true);
        }

        $gameList = $gameListQuery->get();
        $message = $gameList->isEmpty() ? 'No games found matching your filters.' : '';
        return view('gamelist', compact('gameList', 'message', 'user'));
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
    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'status' => 'required|integer',
            'favorite' => 'boolean'
        ]);



            // Create a new record
            GameList::create([
                'user_id' => $request->user_id,
                'game_id' => $request->game_id,
                'status' => $request->status,
                'score' => $request->has('score') ? $request->score : null,
                'favorite' => $request->has('favorite'),
            ]);
        
            session()->flash('success', 'Game successfully added to your list!');
        return redirect()->route('game.show', ['id' => $request->game_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GameList $gameList)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'game_list_id' => 'required|exists:game_lists,id',
            'status' => 'required|integer',
            'favorite' => 'boolean'
        ]);
    
        // Retrieve the game list entry
        $gameList = GameList::findOrFail($request->game_list_id);
    
        // Ensure the authenticated user is authorized to update this game list entry
        if ($gameList->user_id != Auth::id()) {
            abort(403); // Unauthorized
        }
    
        // Update the game list entry
        $gameList->update([
            'status' => $request->status,
            'score' => $request->score,
            'favorite' => $request->has('favorite'),
        ]);
    
        return redirect()->route('game.show', ['id' => $gameList->game_id])->with('success', 'Game list entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'game_list_id' => 'required|exists:game_lists,id',
        ]);
    
        // Retrieve the game list entry
        $gameList = GameList::findOrFail($request->game_list_id);
    
        // Ensure the authenticated user is authorized to delete this game list entry
        if ($gameList->user_id != Auth::id()) {
            abort(403); // Unauthorized
        }
    
        // Delete the game list entry
        $gameList->delete();
    
        return redirect()->route('game.show', ['id' => $gameList->game_id])->with('success', 'Game list entry deleted successfully.');
    }
}
