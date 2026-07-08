<?php

namespace Database\Seeders;

use App\Models\Responsavel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResponsavelSeeder extends Seeder

{

    /**

     * Run the database seeds.

     */

    public function run(): void

    {

        Responsavel::insert([
            [
                'nome' => 'Carlos Alberto Silva',
                'telefone' => '(14) 99711-2233',
                'cpf' => '123.456.789-01',
                'rua' => 'Rua das Flores',
                'numero' => '120',
                'complemento' => 'Casa',
                'bairro' => 'Centro',
                'cidade' => 'Marília',
                'estado' => 'SP',
                'cep' => '17500-000',
                'email' => 'carlos.silva@email.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Fernanda Oliveira',
                'telefone' => '(14) 99822-3344',
                'cpf' => '234.567.890-12',
                'rua' => 'Av. Brasil',
                'numero' => '450',
                'complemento' => null,
                'bairro' => 'Palmital',
                'cidade' => 'Marília',
                'estado' => 'SP',
                'cep' => '17506-120',
                'email' => 'fernanda.oliveira@email.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Marcos Pereira',
                'telefone' => '(14) 99633-4455',
                'cpf' => '345.678.901-23',
                'rua' => 'Rua XV de Novembro',

                'numero' => '89',

                'complemento' => 'Apartamento 12',

                'bairro' => 'Boa Vista',

                'cidade' => 'Marília',

                'estado' => 'SP',

                'cep' => '17502-300',

                'email' => 'marcos.pereira@email.com',

                'password' => Hash::make('12345678'),

                'created_at' => now(),

                'updated_at' => now(),

            ],

            [

                'nome' => 'Juliana Costa',

                'telefone' => '(14) 99544-5566',

                'cpf' => '456.789.012-34',

                'rua' => 'Rua São João',

                'numero' => '210',

                'complemento' => null,

                'bairro' => 'Jardim América',

                'cidade' => 'Marília',

                'estado' => 'SP',

                'cep' => '17515-400',

                'email' => 'juliana.costa@email.com',

                'password' => Hash::make('12345678'),

                'created_at' => now(),

                'updated_at' => now(),

            ],

            [

                'nome' => 'Roberto Martins',

                'telefone' => '(14) 99455-6677',

                'cpf' => '567.890.123-45',

                'rua' => 'Rua Paraná',

                'numero' => '540',

                'complemento' => 'Fundos',

                'bairro' => 'Barbosa',

                'cidade' => 'Marília',

                'estado' => 'SP',

                'cep' => '17511-250',

                'email' => 'roberto.martins@email.com',

                'password' => Hash::make('12345678'),

                'created_at' => now(),

                'updated_at' => now(),

            ],

        ]);
    }
}
