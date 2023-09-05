/*<?php

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
        Schema::table('etablissements', function (Blueprint $table) {
                    $table->foreign('CODE_DREN')->nullable() // Nom de la colonne de la clé étrangère
                    ->references('code_dren') // Colonne de référence dans la table "drens"
                    ->on('drens') // Nom de la table de référence
                    ->onDelete('cascade'); // Action en cas de suppression en cascade
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etablissements', function (Blueprint $table) {
            $table->dropForeign(['code_dren']);
        });
    }
};
