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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Product description (nullable)
            $table->decimal('price', 8, 2); // Price with 8 digits in total, 2 after decimal point
            $table->integer('stock_quantity'); // Quantity of the product in stock
            $table->string('sku')->unique(); // Stock keeping unit (unique value for product identification)
            $table->string('category')->nullable(); // Product category (nullable)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
