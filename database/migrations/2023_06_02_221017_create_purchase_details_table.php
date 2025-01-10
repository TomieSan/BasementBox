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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('address');
            $table->string('province');
            $table->string('zip');
            $table->boolean('sameAddress');
            $table->string('paymentMethod');
            $table->string('nameOnCard');
            $table->string('ccNumber');
            $table->string('ccExpiration');
            $table->string('ccCvv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
