<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'affonso@senac.com'],
            [
                'name' => 'Affonso Admin',
                'password' => Hash::make('12345678'),
                'tipo_usuario' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
