<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // cách 1 : sử dụng "factory" tạo db fake random ngẫu nhiên
        // \App\Models\User::factory(5)->create();
      
        // cách 2 insert trực tiếp "seeder" db tạo tay theo ý mình
        $this->call(UsersSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RoleUserSeeder::class);
    }
}
