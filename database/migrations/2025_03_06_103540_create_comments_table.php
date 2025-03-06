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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('disponibilite_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->text('comment'); 
            $table->tinyInteger('rating')->unsigned()->between(1, 5);
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
