<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Faker\Factory as Faker; 

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   

    public function run(): void
    {
        $faker = Faker::create();
        DB::table('permissions')->insert([
            [
                "key"=>"delete",
                "value"=>"xóa",
            ],
            [
                "key"=>"create",
                "value"=>"tạo",
            ],
            [
                "key"=>"update",
                "value"=>"cập nhật",
            ],
            [
                "key"=>"edit",
                "value"=>"sửa",
            ],
        ]);
    }
}
