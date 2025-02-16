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
        Schema::create('food_posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('rating');
            $table->text('review');
            $table->integer('price');
            $table->string('image');

            $table->foreignId('restaurant_id');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

            $table->foreignId('food_type_id');
            $table->foreign('food_type_id')->references('id')->on('food_types')->onDelete('cascade');

            $table->foreignId('cuisine_type_id');
            $table->foreign('cuisine_type_id')->references('id')->on('cuisine_types')->onDelete('cascade');

            $table->foreignId('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_posts');
    }
};
