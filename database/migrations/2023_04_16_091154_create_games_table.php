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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('publisher_id');
            $table->foreign('publisher_id')->references('id')->on('users');
            $table->longText('description')->nullable();
            $table->string('excerpt')->nullable();
            $table->string('tags')->nullable();
            $table->decimal('price');
            $table->decimal('rating')->default(0);
            $table->string('logo')->nullable();
            $table->string('gamePic1')->nullable();
            $table->string('gamePic2')->nullable();
            $table->string('gamePic3')->nullable();
            $table->string('gamePic4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
