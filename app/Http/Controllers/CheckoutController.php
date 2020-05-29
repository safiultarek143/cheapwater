<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Session;

class CheckoutController extends Controller
{
    public function loginForm(){
        return view('frontend.customer_login');
    }

    public function customerRegister(Request $request)
    {
        Customer::saveCustomerInfo($request);
        return redirect()->route('checkout');
    }

    public function customerLogin(Request $request) {
        $customer = Customer::where('email', $request->email)->first();
        if ($customer) {
            if (password_verify($request->password, $customer->password)) {
                $customerInfo = [
                    'customer_id'=> $customer->id,
                    'customerName' => $customer->first_name.' '.$customer->last_name,
                    'first_name' => $customer->first_name,
                    'last_name' => $customer->last_name,
                    'email' => $customer->email
                ];

                Session::put('customer', $customerInfo);
                return redirect()->route('checkout');
            } else {
                return back()->with('message','Password not valid!');
            }
        } else {
            return back()->with('message','Email address not valid!');
        }
    }

    public function orderPlace(Request $request) {

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'zip' => 'required',
            'telephone' => 'required',
            'payment_method' => 'required',
        ]);

        $shipping = Shipping::create($request->all());
        $payment = Payment::create($request->all());

        if ($customer = Session::get('customer')) {
            $customer_id = $customer['customer_id'];
        } else {
            $customer_id = Customer::GUEST;
        }

        $order = Order::create([
            'customer_id' => $customer_id,
            'shipping_id' => $shipping->id,
            'payment_id' => $payment->id,
            'total' => \Cart::getTotal()
        ]);

        $cartContents = \Cart::getContent();
        foreach ($cartContents as $content) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $content->id,
                'product_name' => $content->name,
                'product_price' => $content->price,
                'product_sales_quantity' => $content->quantity
            ]);
        }

        \Cart::clear();
        Session::flash('success', 'Order Successfully done');
        return redirect()->route('home');
    }
    public function customerLogout()
    {
        Session::forget('customer');
        return redirect()->route('checkout');
    }
    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('checkout')->with('success_msg', 'Item is removed!');
    }
}

