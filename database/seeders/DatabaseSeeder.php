<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Customer::firstOrCreate(
            ['email' => 'alex@example.com'],
            [
                'full_name' => 'Alex Reyes',
                'phone' => '09123456789',
                'address' => 'Manila',
            ]
        );

        Customer::firstOrCreate(
            ['email' => 'sam@example.com'],
            [
                'full_name' => 'Sam Cruz',
                'phone' => null,
                'address' => 'Quezon City',
            ]
        );

        User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo Staff',
                'username' => 'demo_staff',
                'password' => bin2hex(random_bytes(16)),
            ]
        );
    }
}