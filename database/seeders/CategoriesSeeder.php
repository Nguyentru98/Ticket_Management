<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Faker\Factory as Faker; 
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('categories')->insert([
            [
                'categories_name'=>"Internet",
                'description'=>"mất mạng wifi",
            ],
            [
                'categories_name'=>"ERP",
                'description'=>"ERP quản lý doanh nghiệp",
            ],
            [
                'categories_name'=>"LMS",
                'description'=>"Khảo thí online",
            ],
        ]);
    }
}
