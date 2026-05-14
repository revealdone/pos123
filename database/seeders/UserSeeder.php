<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        User::updateOrCreate(
            [
                'email' => 'admin@paktoni.com'
            ],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'cashier@paktoni.com'
            ],
            [
                'name' => 'Cashier',
                'password' => bcrypt('password'),
                'role' => 'cashier'
            ]
        );
    }
}