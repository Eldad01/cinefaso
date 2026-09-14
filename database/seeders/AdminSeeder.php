<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cinefaso.bf'],
            [
                'name' => 'Administrateur',
                'nom' => 'Administrateur',
                'role' => 'admin',
                'lieu_id' => null,
                'password' => Hash::make('CineFaso2026!'),
                'email_verified_at' => now(),
            ]
        );
    }
}
