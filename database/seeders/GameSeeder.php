<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create([
            'name' => 'The Legend of Zelda: Breath of the Wild',
            'description' => 'An action-adventure game set in an open world environment.',
            'genre' => 'Action-Adventure',
            'release_date' => '2017-03-03',
            'developer' => 'Nintendo EPD',
        ]);

        Game::create([
            'name' => 'Grand Theft Auto V',
            'description' => 'An action-adventure game played from either a third-person or first-person perspective.',
            'genre' => 'Action-Adventure',
            'release_date' => '2013-09-17',
            'developer' => 'Rockstar North',
        ]);
        Game::create([
            'name' => 'The Witcher 3: Wild Hunt',
            'description' => 'An action role-playing game set in an open world environment.',
            'genre' => 'RPG',
            'release_date' => '2015-05-19',
            'developer' => 'CD Projekt Red',
        ]);
        Game::create([
            'name' => 'Red Dead Redemption 2',
            'description' => 'An action-adventure game set in the Wild West era.',
            'genre' => 'Action-Adventure',
            'release_date' => '2018-10-26',
            'developer' => 'Rockstar Studios',
        ]);
        Game::create([
            'name' => 'Half-Life',
            'description' => 'A first-person shooter that follows scientist Gordon Freeman.',
            'genre' => 'FPS',
            'release_date' => '1998-11-19',
            'developer' => 'Valve Corporation',
        ]);
        Game::create([
            'name' => 'Half-Life 2',
            'description' => 'The sequel to Half-Life, continuing Gordon Freeman\'s story.',
            'genre' => 'FPS',
            'release_date' => '2004-11-16',
            'developer' => 'Valve Corporation',
        ]);
        Game::create([
            'name' => 'Portal',
            'description' => 'A first-person puzzle-platform video game.',
            'genre' => 'Puzzle-Platformer',
            'release_date' => '2007-10-10',
            'developer' => 'Valve Corporation',
        ]);  
        Game::create([
            'name' => 'Portal 2',
            'description' => 'The sequel to Portal, featuring new gameplay mechanics and characters.',
            'genre' => 'Puzzle-Platformer',
            'release_date' => '2011-04-18',
            'developer' => 'Valve Corporation',
        ]);    
    }
}
