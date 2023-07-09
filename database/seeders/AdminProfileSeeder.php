<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->name = 'Admin';
        $vendor->email = 'admin@gmail.com';
        $vendor->phone_no = '1234567890';
        $vendor->banner = 'https://ui-avatars.com/api/?name=Admin+User';
        $vendor->address = 'Admin Address';
        $vendor->description = 'Admin Description';
        $vendor->fb_link = 'https://www.facebook.com';
        $vendor->twitter_link = 'https://www.twitter.com';
        $vendor->insta_link = 'https://www.instagram.com';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}