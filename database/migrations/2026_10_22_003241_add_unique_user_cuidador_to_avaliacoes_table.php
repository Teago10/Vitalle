
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            $table->unique(
                ['user_id', 'id_cuidador'],
                'avaliacoes_user_cuidador_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            $table->dropUnique(
                'avaliacoes_user_cuidador_unique'
            );
        });
    }
};
