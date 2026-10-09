
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            $table->dropForeign(['id_responsavel']);
            $table->dropColumn('id_responsavel');
        });
    }

    public function down(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            $table->foreignId('id_responsavel')
                ->constrained('responsaveis')
                ->onDelete('cascade');
        });
    }
};
