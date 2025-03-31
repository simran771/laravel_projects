<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MiddlewareController;

class Customer extends Model
{
    protected $fillable = ['phone', 'name', 'email','password','gender','address'];
}
