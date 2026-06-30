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
        Schema::create('cuidadores', function (Blueprint $table) {

            $table->id();
            $table->string('nome', 150);
            $table->string('telefone', 20);
            $table->string('cpf', 14)->unique();
            $table->decimal('avaliacao_media', 3, 2)
                ->default(0);
            $table->string('qualificacao', 150)->nullable();
            $table->string('rua', 200)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('estado', 50)->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('email', 70)
                ->unique();
            $table->string('password');
            $table->string('complemento', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuidadores');
    }
};
