<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Game;

class ProfileController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users', compact('users'));
    }
    /**
     * Display the user's profile form.
     */

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'nullable',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            $user->profile_picture = $path;
        }

        if($request->name !== Null){
            $user->name = $request->name;
        }

        $user->save();

        return Redirect::route('profile.update')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show($id)
    {
        $user = User::findOrFail($id); // Example of fetching game by ID from Eloquent model
        $reviews = Review::all();
        $reviews = $reviews->where('user_id', $user->id);
        $games = Game::all();
        return view('user', compact('user', 'reviews', 'games'));
    }

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'required|string',
        ]);

        $query = $validatedData['search'];

        $users = User::query()
            ->where('name', 'like', "%{$query}%")
            ->get();

        if ($users->isEmpty()) {
            $message = 'No users found matching your search.';
        } else {
            $message = null;
        }

        return view('searchusers', [
            'users' => $users,
            'message' => $message
        ]);
    }
}
