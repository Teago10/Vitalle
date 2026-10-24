
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cuidadores', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
        });

        Schema::table('responsaveis', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        // A reversão exigiria preencher previamente
        // as senhas nulas, portanto não é automática.
    }
};
