<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    protected $fillable = ['name', 'description', 'genre', 'release_date', 'developer', 'image'];
    public function gamelists()
    {
        return $this->hasMany(GameList::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
