<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CustomerController;

class Customer extends Model
{

    protected $fillable = ['phone', 'name', 'email','password','gender','address'];

    public function orders()
    {
        return $this->hasMany(order::class);
    }

    public function cartitem()
    {
        return $this->hasMany(cartitem::class);
    }

    public function payment_methods()
    {
        return $this->belongsToMany(payment_methods::class);
    }
}
