<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_responsavel')
                ->constrained('responsaveis')
                ->cascadeOnDelete();
            $table->string('nome', 150);
            $table->date('data_nascimento');
            $table->string('comorbidade', 200)->nullable();
            $table->string('condicao_fisica', 200)->nullable();
            $table->boolean('usa_fraldas')->default(false);
            $table->string('medicacao', 200)->nullable();
            $table->string('horario_medicacao', 100)->nullable();
            $table->string('rua', 200);
            $table->string('numero', 20);
            $table->string('complemento', 100)->nullable();
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->string('estado', 50);
            $table->string('cep', 10);
            $table->string('email', 70)->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
