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
        Schema::create('plantoes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('id_cuidador')
                ->constrained('cuidadores')
                ->cascadeOnDelete();

            $table->foreignId('id_paciente')
                ->constrained('pacientes')
                ->cascadeOnDelete();

            $table->string('tipo', 20);

            $table->decimal('valor', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantoes');
    }
};
