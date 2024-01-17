<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();

        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'foo@bar.com',
            'password' => '123123123',
        ]);

        $adminUser->roles()->attach($adminRole);

        $editorUser = User::factory()->create([
            'name' => 'Editor',
            'email' => 'bar@foo.com',
            'password' => '123123123',
        ]);

        $editorUser->roles()->attach($editorRole);
    }
}
