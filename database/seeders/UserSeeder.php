<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'username' => 'adminuser',
                'email' => 'admin@gmail.com',
                'image' => "https://ui-avatars.com/api/?name=Admin+User",
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Vendor User',
                'username' => 'vendoruser',
                'email' => 'vendor@gmail.com',
                'image' => "https://ui-avatars.com/api/?name=Vendor+User",
                'role' => 'vendor',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'role' => 'user',
                'status' => 'active',
                'image' => "https://ui-avatars.com/api/?name=User",
                'password' => bcrypt('password')
            ],


        ]);
    }
}