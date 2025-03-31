<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConnectionRequest;
use App\Models\Customer;
use App\Models\Otp;
use Illuminate\Support\Str;
use App\Http\Traits\AuthenticationTrait;

class AuthController extends Controller
{
    use AuthenticationTrait;
    public function get_connection_id(Request $request )
    {
        $API_KEY = "API_KEY";
        if($API_KEY == $request->api_key)
        {
            $connection_id = rand(111111,999999);
            ConnectionRequest::create(["connection_id" => $connection_id]);
            return response()->json([
                "status" => "success",
                "message" => "Connection id generated successfully",
                "connection_id" => $connection_id
            ]);
        }
        return response()-json([
            "status" => "failed",
            "message" => "Invalid Api Key",
        ]);
    }

    public function request_otp(Request $request)
    {
        $valid = $this->validate_connection_id($request->connection_id);

        if(!$valid) //when connection id is not correct
        {
            return response()->json([
                "status" => "failed",
                "error" => "Invalid Connection Id"
            ]);
        }

        // when connection id is correct
        $customer = Customer::where('phone', $request->phone)->first(); //already registered customer
        $otp = $this->generate_otp($request->phone);


        if($customer)
        {
            return response()->json([
                "status" => "success",
                "message" => "Otp Generated Successfully please go for login",
                "otp" => $otp,
                "user" => $customer
            ]);
        }
        else{
            return response()->json([
                "status" => "success",
                "message" => "Otp Generated Successfully please go for Registration",
                "otp" => $otp,
            ]);
        }
        
        return response()->json([
            "status" => "failed",
            "message" => "Otp generation operation failed"
        ]);

    }

    public function register_customer(Request $request)
    {
        $valid = $this->validate_connection_id($request->connection_id);

        if(!$valid) //when connection id is not correct
        {
            return response()->json([
                "status" => "failed",
                "error" => "Invalid Connection Id"
            ]);
        }
        
        $verify = $this->verify_otp($request->otp);

        if(!$verify)
        {
            return response()->json([
                "status" => "failed",
                "message" => "Invalid Otp"
            ]);
        }
        else if($verify == "failed")
        {
            return response()->json([
                "status" => "failed",
                "message" => "Otp Expired"
            ]);
        }
        else if ($verify == "success")
        {
            //create customer
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->password = $request->password;
            $customer->gender = $request->gender;
            $customer->save();

            //generate auth code 
            $auth_code = Str::random(10);
            $valid->auth_code = $auth_code;
            $valid->customer_id = $customer->id;
            return response()->json([
                "status" => "Success",
                "message" => "Customer Registered successfully",
                "data" => [
                    "auth-code" => $auth_code,
                    "customer" => $customer
                ]
            ]);
        }
    }

    public function login(Request $request)
    {
        $valid = $this->validate_connection_id($request->connection_id);

        if(!$valid) //when connection id is not correct
        {
            return response()->json([
                "status" => "failed",
                "error" => "Invalid Connection Id"
            ]);
        }

        $customer = Customer::where(['email' => $request->email, 'password' => $request->password])->first();

        if(!$customer)
        {
            return response()->json([
                "status" => "failed",
                "message" => "Invalid Credential or Register your self before login"
            ]);
        }

        $verify = $this->verify_otp($request->otp);

        if(!$verify)
        {
            return response()->json([
                "status" => "failed",
                "message" => "Invalid Otp"
            ]);
        }
        else if($verify == "failed")
        {
            return response()->json([
                "status" => "failed",
                "message" => "Otp Expired"
            ]);
        }
        else if ($verify == "success")
        {
            //generate auth code 
            $auth_code = Str::random(10);

            //remove from another devices if relogin from other devices
            ConnectionRequest::where('customer_id', $customer->id)->update(['auth_code' => null, 'customer_id' => null]);
            $valid->auth_code = $auth_code;
            $valid->customer_id = $customer->id;
            $valid->save();
            return response()->json([
                "status" => "Success",
                "message" => "Login Successfully",
                "data" => [
                    "auth-code" => $auth_code,
                    "customer" => $customer
                ]
            ]);
        }
        

    }

    private function generate_otp($phone)
    {
        $otp = rand(1111,9999);
        try{
            $otp_record = Otp::firstOrNew(["phone" => $phone]); //if already record availale for this phone number
            $otp_record->otp = $otp;
            $otp_record->expired_on = now()->addMinutes(5);
            $otp_record->save();
            return $otp;
        } 
        catch(\Exception $e)
        {
            return false;
        }
    }

    private function verify_otp($otp)
    {
        $otp = Otp::where('otp', $otp)->first();

        // dd($otp->expired_on, now());
        if(!$otp)
        {
            return false;
        }
        else if($otp->expired_on > now())
        {
            return "success";
        }
        else{
            return "failed";
        }
    }

}
