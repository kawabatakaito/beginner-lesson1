<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->code = $request->code;
        $customer->postal_code = $request->postal_code;
        $customer->address = $request->address;
        $customer->tel = $request->tel;
        $customer->fax = $request->fax;
        if ($customer->save()){
            return;
        } else {
            return redirect('sample.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Customer::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->customer['name'];
        $customer->code = $request->customer['code'];
        $customer->postal_code = $request->customer['postal_code'];
        $customer->address = $request->customer['address'];
        $customer->tel = $request->customer['tel'];
        $customer->fax = $request->customer['fax'];
        if ($customer->update()){
            return;
        } else {
            return redirect('lesson9');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer->delete()){
            return;
        } else {
            return redirect('sample.show');
        }
    }
}
