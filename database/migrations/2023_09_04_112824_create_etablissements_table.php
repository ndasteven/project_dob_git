<?php

use App\Models\Dren;
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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->integer('CODSERVs')->primary();
            $table->string('NOMCOMPLs');
            $table->string('GENREs');
            $table->integer('CODE_DREN');
            $table->timestamps();
        });
        
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
        

    }
};
