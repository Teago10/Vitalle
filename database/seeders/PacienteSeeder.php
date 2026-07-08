<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paciente::insert([
            [
                'id_responsavel' => 1,
                'nome' => 'Maria Aparecida da Silva',
                'data_nascimento' => '1948-05-12',
                'comorbidade' => 'Hipertensão e Diabetes',
                'condicao_fisica' => 'Mobilidade reduzida',
                'usa_fraldas' => true,
                'medicacao' => 'Losartana, Metformina',
                'horario_medicacao' => '08:00, 20:00',
                'rua' => 'Rua das Flores',
                'numero' => '120',
                'complemento' => 'Casa',
                'bairro' => 'Centro',
                'cidade' => 'Marília',
                'estado' => 'SP',
                'cep' => '17500-000',
                'email' => 'maria@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_responsavel' => 2,
                'nome' => 'José Carlos Oliveira',
                'data_nascimento' => '1942-11-20',
                'comorbidade' => 'Alzheimer',
                'condicao_fisica' => 'Necessita auxílio para locomoção',
                'usa_fraldas' => true,
                'medicacao' => 'Donepezila',
                'horario_medicacao' => '09:00',
                'rua' => 'Av. Brasil',
                'numero' => '450',
                'complemento' => null,
                'bairro' => 'Palmital',
                'cidade' => 'Marília',
                'estado' => 'SP',
                'cep' => '17506-120',
                'email' => 'jose@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_responsavel' => 3,
                'nome' => 'Ana Beatriz Souza',
                'data_nascimento' => '1955-08-02',
                'comorbidade' => 'Artrite',
                'condicao_fisica' => 'Boa',
                'usa_fraldas' => false,
                'medicacao' => 'Ibuprofeno',
                'horario_medicacao' => '12:00',
                'rua' => 'Rua XV de Novembro',
                'numero' => '89',
                'complemento' => 'Apartamento 12',
                'bairro' => 'Boa Vista',
                'cidade' => 'Marília',
                'estado' => 'SP',
                'cep' => '17502-300',
                'email' => 'ana@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_responsavel' => 4,
                'nome' => 'Pedro Henrique Lima',
                'data_nascimento' => '1939-03-18',
                'comorbidade' => 'Parkinson',
                'condicao_fisica' => 'Mobilidade comprometida',
                'usa_fraldas' => false,
                'medicacao' => 'Levodopa',
                'horario_medicacao' => '07:00, 13:00, 19:00',
                'rua' => 'Rua São João',
                'numero' => '210',
                'complemento' => null,
                'bairro' => 'Jardim América',
                'cidade' => 'Marília',
                'estado' => 'SP',
                'cep' => '17515-400',
                'email' => 'pedro@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_responsavel' => 5,
                'nome' => 'Helena Martins',
                'data_nascimento' => '1951-09-30',
                'comorbidade' => 'Hipertensão',
                'condicao_fisica' => 'Independente',
                'usa_fraldas' => false,
                'medicacao' => 'Atenolol',
                'horario_medicacao' => '08:00',
                'rua' => 'Rua Paraná',
                'numero' => '540',
                'complemento' => 'Fundos',
                'bairro' => 'Barbosa',
                'cidade' => 'Marília',
                'estado' => 'SP',
                'cep' => '17511-250',
                'email' => 'helena@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
