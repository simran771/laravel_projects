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
        Schema::create('customeraddresses', function (Blueprint $table) {
            $table->id();
            $table->string('street'); // Street Address
            $table->string('city'); // City Name
            $table->string('state')->nullable(); // State Name
            $table->string('zipcode', 10); // Postal Code
            $table->string('country'); // Country Name
            $table->string('phone')->nullable(); // Contact Number
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customeraddresses');
    }
};
