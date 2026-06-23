<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'nome' => 'Thiago Affonso',
            'email' => 'thiago@senacsp.br',
            'password' => Hash::make(12345678),
            'perfil' => 'administrador'
        ],
        [
            'nome' => 'Hanna Amaral',
            'email' => 'hannaA@senacsp.br',
            'password' => Hash::make(12345678),
            'perfil' => 'administrador'
        ]

        ]);
    }
}
