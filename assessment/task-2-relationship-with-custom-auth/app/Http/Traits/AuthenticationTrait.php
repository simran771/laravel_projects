<?php

namespace App\Http\Traits;

use App\Models\ConnectionRequest;

trait AuthenticationTrait {


    public function validate_connection_id($connection_id)
    {
       $valid = ConnectionRequest::where('connection_id', $connection_id)->first();
       return $valid;
    }
    

    public function validateAuth($connection_id,$auth_code)
    {
        $valid = ConnectionRequest::where(['connection_id'=>$connection_id,'auth_code'=>$auth_code])->first();

        return $valid;
    }


}