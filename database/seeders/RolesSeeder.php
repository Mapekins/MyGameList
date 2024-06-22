<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Roles

        $default = Role::Create(['name' => 'Default user']);
        $default_verified = Role::Create(['name' => 'Verified user']);
        $critic = Role::Create(['name' => 'Critic']);
        $editor = Role::Create(['name' => 'Editor']);
        $moderator = Role::Create(['name' => 'Moderator']);
        $admin = Role::Create(['name' => 'Admin']);

//        Permissions

        $set_avatar_permission = Permission::create(['name' => 'set avatar']);
        $review_permission = Permission::create(['name' => 'can leave review']);
        $edit_games_permission = Permission::create(['name' => 'edit gamepages']);
        $remove_reviews_permission = Permission::create(['name' => 'remove review']);
        $assign_roles_permission = Permission::create(['name' => 'assigning roles']);

//        Creating arrays of permissions to assign to the role

        $admin_permissions = [
            $set_avatar_permission,
            $review_permission,
            $edit_games_permission,
            $remove_reviews_permission,
            $assign_roles_permission
        ];
        $moderator_permissions = [
            $set_avatar_permission,
            $review_permission,
            $edit_games_permission,
            $remove_reviews_permission
        ];
        $editor_permissions = [
            $set_avatar_permission,
            $review_permission,
            $edit_games_permission,
        ];
        $default_verified_permissions = [
            $set_avatar_permission,
            $review_permission
        ];

//      Assigning permissions to the role

        $admin->syncPermissions($admin_permissions);
        $moderator->syncPermissions($moderator_permissions);
        $editor->syncPermissions($editor_permissions);
        $default_verified->syncPermissions($default_verified_permissions);
        $critic->syncPermissions($default_verified_permissions);

    }
}
