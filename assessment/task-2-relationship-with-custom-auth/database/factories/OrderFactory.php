<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory

{
    protected $model = Order::class;

    public function definition()
    {
        $paymentMethod = $this->faker->randomElement(['COD', 'online']);
        $onlinePaymentMethod = $paymentMethod === 'online' ? $this->faker->randomElement(['paypal', 'stripe', 'razorpay']) : 'none';

        return [
            'customer_id' => Customer::inRandomOrder()->first()->id, // Randomly pick a customer
            'payment_method' => $paymentMethod,
            'online_payment_method' => $onlinePaymentMethod,
            'total_amount' => $this->faker->randomFloat(2, 50, 500), // Random amount between 50 and 500
        ];
    }
}
