<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Faker\Factory as Faker; 

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Khởi tạo Faker nếu muốn tạo thêm dữ liệu ngẫu nhiên
        $faker = Faker::create();

        // Sử dụng DB facade để chèn dữ liệu vào bảng `users`
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'department_id' => 1,
                'phone' => $faker->phoneNumber(), // Sử dụng Faker để tạo số điện thoại
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // Mã hóa mật khẩu cố định
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'nguyentruhn@gmail.com',
                'email_verified_at' => now(),
                'department_id' => 2,
                'phone' => $faker->phoneNumber(), // Sử dụng Faker để tạo số điện thoại
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // Mã hóa mật khẩu cố định
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'suport',
                'email' => 'trunv98@gmail.com',
                'email_verified_at' => now(),
                'department_id' => 1,
                'phone' => $faker->phoneNumber(), // Sử dụng Faker để tạo số điện thoại
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // Mã hóa mật khẩu cố định
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
