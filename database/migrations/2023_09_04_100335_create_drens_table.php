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
        Schema::create('drens', function (Blueprint $table) {
            $table->integer('code_dren')->primary()->unique();
            $table->string('nom_dren');
            $table->timestamps();  
        });

             
      
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drens');
    }
};
