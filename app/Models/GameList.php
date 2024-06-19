<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameList extends Model
{
    use HasFactory;
    protected $table = 'gamelist';
    protected $fillable = ['status', 'favorite'];
    public function game()
    {
        return $this->hasMany(Game::class, 'game_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
