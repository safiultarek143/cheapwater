<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Shipping;
use Session;
class CustomerController extends Controller
{
    public function userIndex()
    {
;//        if(Session::get('customer'))
//        {
//            return view('user.dashboard');
//        }
//        return redirect()->route('user.dashboard');
        return view('user.dashboard');
    }
    public function userAccount()
    {
        $orders = Order:: where('customer_id',Session::get('customer')['customer_id'])->latest()->get();
        return view('user.account_details', compact('orders'));
    }
    public function userOrders()
    {

            $orders = Order:: where('customer_id',Session::get('customer')['customer_id'])->latest()->get();
            return view('user.orders', compact('orders'));


    }
    public function address()
    {

        $shipping = Shipping:: where('id',Session::get('customer')['customer_id'])->latest()->get();
        return view('user.addresses', compact('shipping'));
//        return view('user.addresses');
    }
}
