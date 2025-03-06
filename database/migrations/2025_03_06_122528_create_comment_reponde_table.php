<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comment_reponde', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('chauffeur_id')->constrained('users')->onDelete('cascade');
            $table->text('reponde'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_reponde');
    }
};
