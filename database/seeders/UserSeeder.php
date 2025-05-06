<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user if not exists
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'is_admin' => 1,
                'plan_id' => Plan::inRandomOrder()->first()->id
            ]);
        }

        $existingUserCount = User::where('is_admin', 0)->count();
        $usersToCreate = max(0, 25 - $existingUserCount);

        for ($i = 0; $i < $usersToCreate; $i++) {
            User::create([
                'name' => 'User ' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@example.com',
                'password' => Hash::make('password'),
                'is_admin' => 0,
                'plan_id' => Plan::inRandomOrder()->first()->id
            ]);
        }
    }
}
