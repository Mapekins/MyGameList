<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['user_id', 'game_id', 'text', 'rating', 'date'];
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
