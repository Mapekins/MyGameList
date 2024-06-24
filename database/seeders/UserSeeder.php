<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Creating filler users

        for($i = 0;$i < 50;$i++){
            $new_user = User::factory()->create();
            $new_user->assignRole(['Admin','Critic','Moderator','Verified user','Editor'][rand(0,4)]);
        };

        // Creating special users

        $admin_user = new User([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);

        $editor_user = new User([
            'name' => 'Editor',
            'email' => 'editor@editor.com',
            'password' => Hash::make('editor')
        ]);

        $moderator_user = new User([
            'name' => 'Moderator',
            'email' => 'moderator@moderator.com',
            'password' => Hash::make('moderator')
        ]);

        $critic_user = new User([
            'name' => 'Critic',
            'email' => 'critic@critic.com',
            'password' => Hash::make('critic')
        ]);

//        saving special users

        $admin_user->save();

        $editor_user->save();

        $moderator_user->save();

        $critic_user->save();

//        assigning roles to them

        $admin_user->assignRole('Admin');

        $editor_user->assignRole('Editor');

        $moderator_user->assignRole('Moderator');

        $critic_user->assignRole('Critic');

    }
}
