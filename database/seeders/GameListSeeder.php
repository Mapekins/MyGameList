<?php

namespace Database\Seeders;
use App\Models\GameList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\table;

class GameListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GameList::factory()->count(150)->create();
    }
}
