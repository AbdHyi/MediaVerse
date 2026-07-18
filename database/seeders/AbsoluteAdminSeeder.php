<?php
// database/seeders/AbsoluteAdminSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AbsoluteAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@mediaverse.test'],
            [
                'name' => 'MediaVerse Super Admin',
                'password' => Hash::make('Admin123!'),
                'role' => 'absolute_admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}