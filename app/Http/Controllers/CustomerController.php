<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\Shipping;
use Illuminate\Support\Facades\Hash;
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
    public function userAccount($id)
    {
        $customer = Customer::find($id);
        return view('user.account_details', compact('customer'));
    }

    public function profileUpdate(Request $request, $id) {
        $rules = [
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'.$id],
        ];
        if ($request->current_password || $request->password) {
            $rules['current_password'] = 'min:8';
            $rules['password'] = 'min:8|confirmed';
        }
        

        $this->validate($request, $rules);

        $customer = Customer::find($id);
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;

        $customer->email = $request->email;
        if ($request->password) {
            if (Hash::check($request->current_password, $customer->password)) {
                $customer->password = bcrypt($request->password);
            }else {
                Session::flash('error','Current Password Doesn\'t Match');
                return back();
            }
        }
        $customer->save();
        Session::flash('success', 'Profile Update Successfully');
        return back();

    }
    public function userOrders()
    {
            $orders = Order:: where('customer_id',Session::get('customer')['customer_id'])->latest()->get();
            return view('user.orders', compact('orders'));
    }
    public function userOrdershow($id)
    {
        $orderDetails = OrderDetails::where('order_id', $id)->get();
        $order = Order::where('id', $id)->with(['customer', 'shipping'])->first();
        $order = Order::where('id', $id)->with(['customer', 'billing'])->first();
        $total = [];
        foreach ($orderDetails as $orderDetail) {
            $subtotal = $orderDetail->product_price * $orderDetail->product_sales_quantity;
            $total[] = $subtotal;

        }
        $total_sum = array_sum($total);

        return view('user.order_show', compact('orderDetails', 'order', 'total_sum'));
    }
    public function address()
    {
        $order = Order:: where('customer_id' ,Session::get('customer')['customer_id'])->with(["shipping","billing"])->latest()->first();

        return view('user.addresses', compact('order'));
    }
    public function editBillingAddress(Request $request, $id)
    {
        $order = Order::where('id', $id)->with(['customer', 'billing'])->first();

        return view('user.edit_billing_address', compact('order'));
    }
    public function editShippingAddress(Request $request, $id)
    {
        $order = Order::where('id', $id)->with(['customer', 'Shipping'])->first();

        return view('user.edit_shipping_address', compact('order'));
    }
    public function updateBillingAddress(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            $billing = Billing::find($order->billing_id);
            $billing->first_name = $request->first_name;
            $billing->last_name = $request->last_name;
            $billing->email = $request->email;
            $billing->address = $request->address;
            $billing->city = $request->city;
            $billing->country = $request->country;
            $billing->zip = $request->zip;
            $billing->telephone = $request->telephone;
            $billing->save();
            Session::flash('success', 'billing Address Update Successfully');
            return back();
        }
    }
        public function updateShippingAddress(Request $request, $id)
    {
        $order = Order::find($id);
        if($order){
            $shipping = Shipping::find($order->shipping_id);
            $shipping->first_name = $request->first_name;
            $shipping->last_name = $request->last_name;
            $shipping->email = $request->email;
            $shipping->address = $request->address;
            $shipping->city = $request->city;
            $shipping->country = $request->country;
            $shipping->zip = $request->zip;
            $shipping->telephone = $request->telephone;
            $shipping->save();
            Session::flash('success', 'shipping Address Update Successfully');
            return back();
        }

    }


}
