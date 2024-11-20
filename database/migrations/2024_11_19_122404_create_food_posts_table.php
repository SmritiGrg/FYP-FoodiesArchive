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
            $table->text('description');
            $table->decimal('price', 4, 2);
            $table->string('image');
            
            $table->foreignId('restaurant_id');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->foreignId('sub_cat_id');
            $table->foreign('sub_cat_id')->references('id')->on('sub_categories')->onDelete('cascade');
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
