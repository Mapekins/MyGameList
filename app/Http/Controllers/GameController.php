<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Review;
use App\Models\User;
use App\Models\GameList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('name')->get();
        $reviews = Review::all();
        $game_lists = GameList::all();
        $users = User::all();
// Extract and organize review data
        $reviewData = $reviews->map(function ($review) {
            return [
                'user_id' => $review->user_id,
                'game_id' => $review->game_id,
                'rating' => $review->rating,
                'source' => 'review' // Mark as review source
            ];
        });

// Extract and organize game list data
        $gameListData = $game_lists->map(function ($gameList) {
            return [
                'user_id' => $gameList->user_id,
                'game_id' => $gameList->game_id,
                'rating' => $gameList->score,
                'source' => 'game_list' // Mark as game list source
            ];
        });

// Combine both data sets
        $combinedData = $reviewData->merge($gameListData);

// Initialize arrays to store game ratings and counts
        $gameRatings = [];
        $gameCounts = [];

// Process combined data to calculate average ratings per game
        foreach ($combinedData as $data) {
            $userId = $data['user_id'];
            $gameId = $data['game_id'];
            $rating = $data['rating'];
            $source = $data['source'];

            // Check if user_id is not already counted from a review
            if ($source === 'review' || !isset($gameCounts[$gameId][$userId])) {
                // Increment count for the game and user
                $gameCounts[$gameId][$userId] = true;

                // Add rating to game ratings
                if (!isset($gameRatings[$gameId])) {
                    $gameRatings[$gameId] = ['total' => 0, 'count' => 0];
                }
                $gameRatings[$gameId]['total'] += $rating;
                $gameRatings[$gameId]['count']++;
            }
        }

// Calculate average ratings for each game
        $averageRatings = [];

        foreach ($gameRatings as $gameId => $data) {
            if ($data['count'] > 0) {
                $averageRating = $data['total'] / $data['count'];
                $averageRatings[] = [
                    'game_id' => $gameId,
                    'average_rating' => number_format($averageRating, 2)
                ];
            }
        }// $averageRatings now contains the average rating for each game_id

        usort($averageRatings, function ($a, $b) {
            return $b['average_rating'] <=> $a['average_rating'];
        });


        return view('main', compact('games', 'averageRatings', 'reviews', 'users'));

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
            'message' => $message,
        ]);
    }

    public function show($id)
    {
        $reviews = Review::where('game_id', $id)->orderBy('date')->get();
        $users = User::whereIn('id', $reviews->pluck('user_id'))->get();
        $game = Game::findOrFail($id);
        $userReview = Review::where('game_id', $id)->where('user_id', Auth::id())->first();
        $userGameListEntry = GameList::where('user_id', Auth::id())->where('game_id', $id)->first();

        $gameListEntries = GameList::where('game_id', $id)->get();
        $glistUsers = User::whereIn('id', $gameListEntries->pluck('user_id'))->get();
        $usersforgrade = $users->merge($glistUsers);


        return view('game', compact('game', 'reviews', 'users', 'userReview', 'userGameListEntry', 'usersforgrade', 'gameListEntries'));
    }

    public function delete(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
        ]);

        // Retrieve the game list entry
        $game = Game::findOrFail($request->game_id);

        // Ensure the authenticated user is authorized to delete this game list entry
        if (!Auth::user()->hasRole('Admin') && !Auth::user()->hasRole('Editor')) {
            abort(403, 'Unauthorized.');
        }

        // Delete the game list entry
        $game->delete();

        return redirect()->route('main');
    }

    public function create(Request $request)
    {
        $request->validate([
            'game_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048',
            'title' => 'required|string',
            'descr' => 'required|string',
            'genre' => 'required|string',
            'reldate' => 'required|date',
            'dev' => 'required|string',
        ]);

        if ($request->hasFile('game_logo')) {
            $path = $request->file('game_logo')->store('game_logos', 'public');

            $request->game_logo = $path;
        }


            // Create a new record
            Game::create([
                'name' => $request->title,
                'description' => $request->descr,
                'genre' => $request->genre,
                'release_date' => $request->reldate,
                'developer' => $request->dev,
                'image' => $request->game_logo
            ]);

        return redirect()->route('main');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'game_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048',
            'title' => 'required|string',
            'descr' => 'required|string',
            'genre' => 'required|string',
            'reldate' => 'required|date',
            'dev' => 'required|string',
        ]);


        $game = Game::findOrFail($request->game_id);

        if ($request->hasFile('game_logo')) {
            if ($request->game_logo) {
                if ($game->image) {
                    Storage::delete($game->image);
                }

            }
            $path = $request->file('game_logo')->store('game_logos', 'public');

            $game->image = $path;
            $game->save();

        }


            // Create a new record
            $game->update([
                'name' => $request->title,
                'description' => $request->descr,
                'genre' => $request->genre,
                'release_date' => $request->reldate,
                'developer' => $request->dev,
            ]);

            return redirect()->route('game.show', ['id' => $request->game_id])->with('success', __('game_update_suc'));
    }

}
