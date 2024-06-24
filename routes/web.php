<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GameListController;
use App\Http\Controllers\RoleController;

Route::get('/', [GameController::class, 'index'])->name('main');

Route::get('/search', [GameController::class, 'search'])->name('game.search');

Route::get('/game/{id}', [GameController::class, 'show'])->name('game.show');

Route::get('/users', [ProfileController::class, 'index'])->name('user.index');

Route::get('/searchUsers', [ProfileController::class, 'search'])->name('user.search');

Route::get('/user/{id}', [ProfileController::class, 'show'])->name('user.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/reviews/update', [ReviewController::class, 'update'])->name('reviews.update');
Route::post('/reviews/destroy', [ReviewController::class, 'destroy'])->name('reviews.destroy');

Route::post('/game-list/store', [GameListController::class, 'store'])->name('game-list.store');
Route::post('/game-list/update', [GameListController::class, 'update'])->name('game-list.update');
Route::post('/game-list/destroy', [GameListController::class, 'destroy'])->name('game-list.destroy');

Route::get('/user/{id}/gamelist', [GameListController::class, 'index'])->name('game-list.index');

Route::post('/role/change', [RoleController::class, 'change'])->name('role.change');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tailwind', function () {
    return view('tailwind');
});

require __DIR__.'/auth.php';
