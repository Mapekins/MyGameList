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
            'image' => 'botw.jpg',
        ]);

        Game::create([
            'name' => 'Grand Theft Auto V',
            'description' => 'An action-adventure game played from either a third-person or first-person perspective.',
            'genre' => 'Action-Adventure',
            'release_date' => '2013-09-17',
            'developer' => 'Rockstar North',
            'image' => 'GTA5.png',
        ]);
        Game::create([
            'name' => 'The Witcher 3: Wild Hunt',
            'description' => 'An action role-playing game set in an open world environment.',
            'genre' => 'RPG',
            'release_date' => '2015-05-19',
            'developer' => 'CD Projekt Red',
            'image' => 'witcher3.jpg',
        ]);
        Game::create([
            'name' => 'Red Dead Redemption 2',
            'description' => 'An action-adventure game set in the Wild West era.',
            'genre' => 'Action-Adventure',
            'release_date' => '2018-10-26',
            'developer' => 'Rockstar Studios',
            'image' => 'rdr2.jpg',
        ]);
        Game::create([
            'name' => 'Half-Life',
            'description' => 'A first-person shooter that follows scientist Gordon Freeman.',
            'genre' => 'FPS',
            'release_date' => '1998-11-19',
            'developer' => 'Valve Corporation',
            'image' => 'HL1.jpg',
        ]);
        Game::create([
            'name' => 'Half-Life 2',
            'description' => 'The sequel to Half-Life, continuing Gordon Freeman\'s story.',
            'genre' => 'FPS',
            'release_date' => '2004-11-16',
            'developer' => 'Valve Corporation',
            'image' => 'HL2.jpg',
        ]);
        Game::create([
            'name' => 'Portal',
            'description' => 'A first-person puzzle-platform video game.',
            'genre' => 'Puzzle-Platformer',
            'release_date' => '2007-10-10',
            'developer' => 'Valve Corporation',
            'image' => 'Portal.jpg',
        ]);  
        Game::create([
            'name' => 'Portal 2',
            'description' => 'The sequel to Portal, featuring new gameplay mechanics and characters.',
            'genre' => 'Puzzle-Platformer',
            'release_date' => '2011-04-18',
            'developer' => 'Valve Corporation',
            'image' => 'Portal2.jpg',
        ]); 
        Game::create([
            'name' => 'Cyberpunk 2077',
            'description' => 'An open-world RPG set in a dystopian future, featuring a vast city to explore and multiple branching storylines.',
            'genre' => 'Action RPG',
            'release_date' => '2020-12-10',
            'developer' => 'CD Projekt Red',
            'image' => 'Cyberpunk2077.jpg',
        ]);
        Game::create([
            'name' => 'Dark Souls III',
            'description' => 'The final chapter in the critically acclaimed Dark Souls series, known for its challenging combat and deep lore.',
            'genre' => 'Action RPG',
            'release_date' => '2016-04-12',
            'developer' => 'FromSoftware',
            'image' => 'DarkSouls3.jpg',
        ]);
        Game::create([
            'name' => 'Ghost of Tsushima',
            'description' => 'An open-world samurai action-adventure game set in feudal Japan, featuring beautiful landscapes and intense sword combat.',
            'genre' => 'Action-Adventure',
            'release_date' => '2020-07-17',
            'developer' => 'Sucker Punch Productions',
            'image' => 'GhostOfTsushima.jpg',
        ]);
        Game::create([
            'name' => 'Sekiro: Shadows Die Twice',
            'description' => 'A third-person, action-adventure game with RPG elements set in a reimagined late 1500s Sengoku period Japan.',
            'genre' => 'Action-Adventure',
            'release_date' => '2019-03-22',
            'developer' => 'FromSoftware',
            'image' => 'Sekiro.jpg',
        ]);
        Game::create([
            'name' => 'Dark Souls',
            'description' => 'A dark fantasy action RPG known for its challenging difficulty, intricate world design, and deep lore.',
            'genre' => 'Action RPG',
            'release_date' => '2011-09-22',
            'developer' => 'FromSoftware',
            'image' => 'DarkSouls.jpg',
        ]);

        Game::create([
            'name' => 'Dark Souls II',
            'description' => 'The second installment in the Dark Souls series, featuring a vast world to explore and difficult combat.',
            'genre' => 'Action RPG',
            'release_date' => '2014-03-11',
            'developer' => 'FromSoftware',
            'image' => 'DarkSouls2.jpg',
        ]);

        Game::create([
            'name' => 'The Witcher',
            'description' => 'The first game in the Witcher series, where players assume the role of Geralt of Rivia in a dark fantasy world.',
            'genre' => 'Action RPG',
            'release_date' => '2007-10-26',
            'developer' => 'CD Projekt Red',
            'image' => 'TheWitcher.jpg',
        ]);

        Game::create([
            'name' => 'The Witcher 2: Assassins of Kings',
            'description' => 'The second game in the Witcher series, continuing the story of Geralt of Rivia with improved graphics and combat.',
            'genre' => 'Action RPG',
            'release_date' => '2011-05-17',
            'developer' => 'CD Projekt Red',
            'image' => 'Witcher2.jpg',
        ]);

        Game::create([
            'name' => 'Chrono Trigger',
            'description' => 'A classic RPG featuring time travel, a compelling story, and memorable characters.',
            'genre' => 'RPG',
            'release_date' => '1995-03-11',
            'developer' => 'Square Enix',
            'image' => 'ChronoTrigger.jpg',
        ]);

        Game::create([
            'name' => 'Devil May Cry 5',
            'description' => 'A fast-paced action game featuring stylish combat, multiple playable characters, and a gripping story.',
            'genre' => 'Action',
            'release_date' => '2019-03-08',
            'developer' => 'Capcom',
            'image' => 'DevilMayCry5.jpg',
        ]);

        Game::create([
            'name' => 'Doom (2016)',
            'description' => 'A reboot of the classic first-person shooter franchise, featuring fast-paced combat and intense action.',
            'genre' => 'First-Person Shooter',
            'release_date' => '2016-05-13',
            'developer' => 'id Software',
            'image' => 'Doom2016.jpg',
        ]);

        Game::create([
            'name' => 'Fallout 4',
            'description' => 'An open-world RPG set in a post-apocalyptic world, where players must survive and rebuild in the aftermath of a nuclear war.',
            'genre' => 'Action RPG',
            'release_date' => '2015-11-10',
            'developer' => 'Bethesda Game Studios',
            'image' => 'Fallout4.jpg',
        ]);

        Game::create([
            'name' => 'Metal Gear Rising: Revengeance',
            'description' => 'An action game set in the Metal Gear universe, featuring fast-paced combat and a gripping story.',
            'genre' => 'Action',
            'release_date' => '2013-02-19',
            'developer' => 'PlatinumGames',
            'image' => 'MetalGearRising.jpg',
        ]);

        Game::create([
            'name' => 'Metro Exodus',
            'description' => 'A first-person shooter set in a post-apocalyptic world, featuring a mix of combat and survival horror elements.',
            'genre' => 'First-Person Shooter',
            'release_date' => '2019-02-15',
            'developer' => '4A Games',
            'image' => 'MetroExodus.jpg',
        ]);

        Game::create([
            'name' => 'Metro 2033 Redux',
            'description' => 'A remastered version of the original Metro 2033, featuring improved graphics and gameplay.',
            'genre' => 'First-Person Shooter',
            'release_date' => '2014-08-26',
            'developer' => '4A Games',
            'image' => 'Metro2033Redux.png',
        ]);
        Game::create([
            'name' => 'NieR: Automata',
            'description' => 'An action RPG set in a dystopian future, featuring fast-paced combat, a deep story, and multiple endings.',
            'genre' => 'Action RPG',
            'release_date' => '2017-02-23',
            'developer' => 'PlatinumGames',
            'image' => 'NierAutomata.jpg',
        ]);

        Game::create([
            'name' => 'Return to Castle Wolfenstein',
            'description' => 'A first-person shooter set during World War II, where players must stop the Nazis from using supernatural forces.',
            'genre' => 'First-Person Shooter',
            'release_date' => '2001-11-19',
            'developer' => 'Gray Matter Interactive',
            'image' => 'rtcw.jpg',
        ]);

        Game::create([
            'name' => 'Wolfenstein II: The New Colossus',
            'description' => 'A first-person shooter set in an alternate history where the Nazis won World War II, featuring intense combat and a gripping story.',
            'genre' => 'First-Person Shooter',
            'release_date' => '2017-10-27',
            'developer' => 'MachineGames',
            'image' => 'Wolf2.jpeg',
        ]);   
    }
}
