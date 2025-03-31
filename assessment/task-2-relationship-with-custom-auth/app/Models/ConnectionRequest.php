<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectionRequest extends Model
{
    protected $fillable = ['connection_id', 'auth_code', 'customer_id'];
}
