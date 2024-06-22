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
        User::factory(50)->create();

        // Creating special users

        $admin_user = new User([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);
        $editor_user = new User([
            'name' => 'editor',
            'email' => 'editor@editor.com',
            'password' => Hash::make('editor')
        ]);
        $moderator_user = new User([
            'name' => 'moderator',
            'email' => 'moderator@moderator.com',
            'password' => Hash::make('moderator')
        ]);
        $critic_user = new User([
            'name' => 'critic',
            'email' => 'critic@critic.com',
            'password' => Hash::make('critic')
        ]);

//        saving special users

        $admin_user->save();
        $editor_user->save();
        $moderator_user->save();
        $critic_user->save();

//        assigning roles to them

        $admin_user->assignRole('admin');
        $editor_user->assignRole('editor');
        $moderator_user->assignRole('moderator');
        $critic_user->assignRole('critic');

    }
}
