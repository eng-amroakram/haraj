<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@haraj.com",
            'password' => Hash::make("123456"),
            "email_verified_at" => now(),
            'phone' => "0599916672",
            'type' => "admin",
            'status' => "active",
        ]);
    }
}
