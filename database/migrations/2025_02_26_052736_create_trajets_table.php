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
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('lieu');
            $table->string('destination');
            $table->enum('statut' , ['en attente', 'accepte', 'refuse', 'annule'])->default('en attente');
            $table->unsignedBigInteger('id_passager');
            $table->foreign('id_passager')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('id_dispo');
            $table->foreign('id_dispo')->references('id')->on('disponibilites')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
