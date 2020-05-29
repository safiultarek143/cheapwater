<?php

namespace App\Models;
use Session;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    CONST GUEST = 0;
    public static function saveCustomerInfo($request) {
        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->save();

        $customerInfo = [
            'customerName' => $customer->first_name.' '.$customer->last_name,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email
        ];

        Session::put('customer', $customerInfo);
    }
}
