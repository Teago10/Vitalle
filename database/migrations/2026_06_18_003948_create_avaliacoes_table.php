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
        Schema::create('avaliacoes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('id_cuidador')
                ->constrained('cuidadores')
                ->cascadeOnDelete();

            $table->foreignId('id_responsavel')
                ->constrained('responsaveis')
                ->cascadeOnDelete();

            $table->tinyInteger('nota');

            $table->string('comentario', 500)
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
