<?php

namespace App\Http\Controllers;

use App\Models\customerAddress;
use App\Http\Requests\StorecustomerAddressRequest;
use App\Http\Requests\UpdatecustomerAddressRequest;

class CustomerAddressController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // return "MY NAME IS SIMRAN CHAURASIYA";
        $address = ["name" => "simran", "email" => "simran@example.com","city"=>"Baitalpur"];
        return view('Webpage', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecustomerAddressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(customerAddress $customerAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customerAddress $customerAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecustomerAddressRequest $request, customerAddress $customerAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customerAddress $customerAddress)
    {
        //
    }
}
