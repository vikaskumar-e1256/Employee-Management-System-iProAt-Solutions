<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'is_admin' => true,
            'password' => bcrypt(1)
        ]);

        User::factory()->create([
            'username' => 'user',
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt(1)
        ]);

        // Employee::factory()->count(5)->create();
    }
}
