<?php

namespace App\Models;
use App\Models\OrderItem;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\OrderController;

class Order extends Model
{
    protected $fillable = ['customer_id', 'payment_method', 'online_payment_method','total_amount'];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
