<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
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

        for ($i = 1; $i <= 10; $i++) {
            // user
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => Carbon::now(),
                'isAdmin' => false,
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
