<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();
        \App\Models\Ticket::factory(5)->create();
        \App\Models\Notification::factory(5)->create();
        \App\Models\Department::factory(5)->create();
        \App\Models\Categori::factory(5)->create();
        \App\Models\Roles::factory(5)->create();
        \App\Models\RoleUser::factory(5)->create();
        \App\Models\permission::factory(5)->create();
        \App\Models\permission_role::factory(5)->create();
    }
}
