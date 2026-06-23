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
        Schema::create('disponibilidades', function (Blueprint $table) {

            $table->id();

            $table->foreignId('id_cuidador')
                ->constrained('cuidadores')
                ->cascadeOnDelete();

            $table->string('dia_semana', 20);

            $table->time('horario_inicio');

            $table->time('horario_fim');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilidades');
    }
};
