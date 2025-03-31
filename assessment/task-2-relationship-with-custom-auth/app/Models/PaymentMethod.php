<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public function customers()
    {
        return $this->belongsToMany(customers::class);
    }
}
