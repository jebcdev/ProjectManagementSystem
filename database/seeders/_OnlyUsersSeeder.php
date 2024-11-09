<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class _OnlyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        User::create([
            'name' => '{ JEBC-DeV }',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now(),
            'isAdmin' => true,
            'password' => Hash::make('12345678'),
        ]);

         // user
         User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'email_verified_at' => Carbon::now(),
            'isAdmin' => false,
            'password' => Hash::make('12345678'),
        ]);
    }
}
