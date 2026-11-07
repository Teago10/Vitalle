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
        Schema::table('avaliacoes', function (Blueprint $table) {
            if (!Schema::hasColumn('avaliacoes', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('avaliacoes', 'comentario')) {
                $table->text('comentario')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            if (Schema::hasColumn('avaliacoes', 'comentario')) {
                $table->dropColumn('comentario');
            }

            if (Schema::hasColumn('avaliacoes', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
