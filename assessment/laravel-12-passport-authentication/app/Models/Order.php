<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\OrderController;

class Order extends Model
{
    protected $fillable = ['customer_id', 'status', 'product name', 'total_amount'];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
