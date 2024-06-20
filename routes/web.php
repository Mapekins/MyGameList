<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    $games = app(GameController::class)->index();

    return view('main', ['games' => $games]);
})->name('main');

Route::get('/search', [GameController::class, 'search'])->name('search');

Route::get('/game/{id}', [GameController::class, 'show'])->name('game.show');

Route::get('/user/{id}', [ProfileController::class, 'show'])->name('user.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

Route::post('/reviews/update', [ReviewController::class, 'update'])->name('reviews.update');

Route::post('/reviews/destroy', [ReviewController::class, 'destroy'])->name('reviews.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tailwind', function () {
    return view('tailwind');
});

require __DIR__.'/auth.php';
