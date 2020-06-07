<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Shipping;
use App\Traits\AuthorizePaymentTraits;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Session;

class CheckoutController extends Controller
{
    use AuthorizePaymentTraits;

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
            'b_first_name' => 'required',
            'b_last_name' => 'required',
            'b_email' => 'required',
            'b_address' => 'required',
            'b_city' => 'required',
            'b_country' => 'required',
            'b_zip' => 'required',
            'b_telephone' => 'required',
            'payment_method' => 'required',
        ]);

        $card_number = $request->card_number;
        $cvv = $request->cvv;
        $exp_month = $request->exp_month;
        $exp_year = $request->exp_year;
        $expiration_date = $exp_year.'-'.$exp_month;
        $amount = \Cart::getTotal();

        $charge_card = $this->chargeCreditCard($card_number, $cvv, $expiration_date, $amount);
        if ($charge_card['success']) {
            $trans_id = $charge_card['transaction_id'];
            $payment_status = $charge_card['payment_status'];
        }else {
            Session::flash('error', 'Your transaction has been failed. Please try again.');
            return back();
        }

        $billing = new Billing();
        $billing->first_name = $request->b_first_name;
        $billing->last_name = $request->b_last_name;
        $billing->email = $request->b_email;
        $billing->address = $request->b_address;
        $billing->city = $request->b_city;
        $billing->country = $request->b_country;
        $billing->zip = $request->b_zip;
        $billing->telephone = $request->b_telephone;
        $billing->save();
        if(empty($request->s_first_name)){
            $shipping = new Shipping();
            $shipping->first_name = $request->b_first_name;
            $shipping->last_name = $request->b_last_name;
            $shipping->email = $request->b_email;
            $shipping->address = $request->b_address;
            $shipping->city = $request->b_city;
            $shipping->country = $request->b_country;
            $shipping->zip = $request->b_zip;
            $shipping->telephone = $request->b_telephone;
            $shipping->save();
        }
        else {
            $shipping = new Shipping();
            $shipping->first_name = $request->s_first_name;
            $shipping->last_name = $request->s_last_name;
            $shipping->email = $request->s_email;
            $shipping->address = $request->s_address;
            $shipping->city = $request->s_city;
            $shipping->country = $request->s_country;
            $shipping->zip = $request->s_zip;
            $shipping->telephone = $request->s_telephone;
            $shipping->save();
        }

        $payment = new Payment();
        $payment->payment_method = $request->payment_method;
        $payment->transaction_id = $trans_id;
        $payment->amount = \Cart::getTotal();
        $payment->payment_status = $payment_status;
        $payment->save();

        if ($customer = Session::get('customer')) {
            $customer_id = $customer['customer_id'];
        } else {
            $customer_id = Customer::GUEST;
        }

        $order = Order::create([
            'customer_id' => $customer_id,
            'billing_id' => $billing->id,
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

