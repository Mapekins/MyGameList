<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    public function gamelist()
    {
        return $this->hasMany(GameList::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class);
    }
}
