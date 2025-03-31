<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->count(5)->create(['payment_method' => 'COD']);

        // Generate 5 orders with Online payment method
        Order::factory()->count(5)->create(['payment_method' => 'online']);
    }
}
