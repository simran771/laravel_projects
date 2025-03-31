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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // assuming a customer table exists
            $table->enum('payment_method', ['COD', 'online']); // Payment method field
            $table->enum('online_payment_method', ['paypal', 'stripe', 'razorpay', 'none'])->default('none'); // for online payment methods
            $table->decimal('total_amount', 8, 2); // total order amount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
