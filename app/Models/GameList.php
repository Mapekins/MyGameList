<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameList extends Model
{
    use HasFactory;
    protected $table = 'game_lists';
    protected $fillable = ['user_id', 'game_id', 'status', 'score', 'favorite'];
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
