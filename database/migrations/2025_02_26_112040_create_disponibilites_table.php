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
        Schema::create('disponibilites', function (Blueprint $table) {
            $table->id(); 
            $table->date('dateDebut');
            $table->date('dateFin'); 
            $table->string('destination', 255); 
            $table->enum('statut', ['active', 'desactive'])->default('active'); 
            $table->unsignedBigInteger('id_chauffeur');
            $table->foreign('id_chauffeur') 
                ->references('id') 
                ->on('users') 
                ->onDelete('cascade') 
                ->onUpdate('cascade'); 
            $table->timestamps(); 
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilites');
    }
};
