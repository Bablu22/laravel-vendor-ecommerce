<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->name = 'Vendhor Shop';
        $vendor->email = 'vendor@gmail.co0m';
        $vendor->phone_no = '1234567890';
        $vendor->banner = 'https://ui-avatars.com/api/?name=Admin+User';
        $vendor->address = 'USA';
        $vendor->description = 'AShop Description';
        $vendor->fb_link = 'https://www.facebook.com';
        $vendor->twitter_link = 'https://www.twitter.com';
        $vendor->insta_link = 'https://www.instagram.com';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}