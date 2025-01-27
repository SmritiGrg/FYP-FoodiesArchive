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
            $table->integer('amount_paid');
            $table->string('payment_method');
            $table->string('khalti_transaction_id');
            $table->enum('status', ['Paid', 'Pending', 'Failed']);
            $table->dateTime('payment_date');
            $table->foreignId('subscriber_id');
            $table->foreign('subscriber_id')->references('id')->on('user_subscribers')->onDelete('cascade');
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
