<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@nexfix.com'],
            [
                'name' => 'Admin Mahidul',
                'password' => Hash::make('123456789'),
                'role' => 'admin',
            ]
        );
    }
}
