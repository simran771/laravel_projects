<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'stock_quantity','image_url', 'price'];


    public function cartitems()
    {
        return $this->hasMany(cartitems::class);
    }
}