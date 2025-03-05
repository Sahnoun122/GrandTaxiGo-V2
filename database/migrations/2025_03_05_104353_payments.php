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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();        
        $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        $table->string('stripe_payment_id');
        $table->integer('amount'); 
        $table->string('currency')->default('$'); 
        $table->enum('status', ['reussi', 'echec', 'en_attente'])->default('en_attente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
