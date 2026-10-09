<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Cuidador;

class CuidadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cuidador::create([
            'nome' => 'João Silva',
            'telefone' => '(14) 99999-1111',
            'cpf' => '111.111.111-11',
            'avaliacao_media' => 4.50,
            'qualificacao' => 'Cuidador de idosos',
            'rua' => 'Rua das Flores',
            'numero' => '100',
            'bairro' => 'Centro',
            'cidade' => 'Marília',
            'estado' => 'SP',
            'cep' => '17500-000',
            'email' => 'joao.silva@vitalle.com',
            'password' => Hash::make('12345678'),
            'complemento' => null,
        ]);

        Cuidador::create([
            'nome' => 'Maria Souza',
            'telefone' => '(14) 98888-2222',
            'cpf' => '222.222.222-22',
            'avaliacao_media' => 4.80,
            'qualificacao' => 'Técnica de enfermagem',
            'rua' => 'Rua São Paulo',
            'numero' => '250',
            'bairro' => 'Cascata',
            'cidade' => 'Marília',
            'estado' => 'SP',
            'cep' => '17501-000',
            'email' => 'maria.souza@vitalle.com',
            'password' => Hash::make('12345678'),
            'complemento' => null,
        ]);

        Cuidador::create([
            'nome' => 'Carlos Oliveira',
            'telefone' => '(14) 97777-3333',
            'cpf' => '333.333.333-33',
            'avaliacao_media' => 4.20,
            'qualificacao' => 'Auxiliar de cuidador',
            'rua' => 'Avenida Brasil',
            'numero' => '350',
            'bairro' => 'Jardim América',
            'cidade' => 'Marília',
            'estado' => 'SP',
            'cep' => '17502-000',
            'email' => 'carlos.oliveira@vitalle.com',
            'password' => Hash::make('12345678'),
            'complemento' => null,
        ]);
    }
}
