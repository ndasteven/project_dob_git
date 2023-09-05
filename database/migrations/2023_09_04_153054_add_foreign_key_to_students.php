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
        Schema::table('students', function (Blueprint $table) {
            $table->foreign('CODE_ETABLISSEMENT') // Nom de la colonne de la clé étrangère
            ->references('CODSERVs') // Colonne de référence dans la table "etablissement"
            ->on('etablissements') // Nom de la table de référence
            ->onDelete('cascade'); // Action en cas de suppression en cascade
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['CODE_ETABLISSEMENT']);
        });
    }
};

