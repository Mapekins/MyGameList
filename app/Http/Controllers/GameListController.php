<?php

namespace App\Http\Controllers;

use App\Models\GameList;
use Illuminate\Http\Request;

class GameListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $gameList = GameList::where('user_id', $userId)->get();
        return $gameList;
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
            'game_id' => 'required',
            'status' => 'required',
            'favorite' => 'required'
        ]);

        $gameList = new GameList();
        $gameList->user_id = Auth::id();
        $gameList->game_id = $request->game_id;
        $gameList->status = $request->status;
        $gameList->favorite = $request->favorite;
        $gameList->save();

        return redirect()->route('game_list.show', $gameList);
    }

    /**
     * Display the specified resource.
     */
    public function show(GameList $gameList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GameList $gameList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GameList $gameList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameList $gameList)
    {
        //
    }
}
