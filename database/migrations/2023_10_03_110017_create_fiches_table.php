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
        Schema::create('fiches', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('remarkFiche')->nullable();
            $table->string('fiche_nom');
            $table->string('classe');
            $table->string('type_fiche');
            $table->integer('annee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiches');
    }
};
