<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Faker\Factory as Faker; 

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('departments')->insert([
            [
                'department_name'=>'PCN',
                'description'=>'Phòng công nghệ',
            ],
            [
                'department_name'=>'PNS',
                'description'=>'Phòng nhân sự',
            ],
            [
                'department_name'=>'PHC',
                'description'=>'Phòng hành chính',
            ],
            [
                'department_name'=>'PKT',
                'description'=>'Phòng kế toán',
            ],
        ]);
    }
}
