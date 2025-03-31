<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['customer_id', 'product_name', 'quantity','price'];


    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
