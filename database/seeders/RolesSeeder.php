<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Faker\Factory as Faker; 

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                "name"=>"admin",
                "status"=>"active",
            ],
            [
                "name"=>"user",
                "status"=>"active",
            ],
            [
                "name"=>"suport",
                "status"=>"active",
            ],
        ]);
    }
}
