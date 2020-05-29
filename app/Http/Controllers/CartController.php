<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;
class CartController extends Controller
{
    public function shop()
    {
        $products = Product::all();

        return view('frontend.shop')->withTitle('E-COMMERCE STORE | SHOP')->with(['products' => $products]);
    }
    public function checkout()
    {
//        $products = Product::all();
        $cartCollection = \Cart::getContent();
        if(count($cartCollection)){
            return view('frontend.checkout')->withTitle('E-COMMERCE STORE | SHOP')->with(['cartCollection' => $cartCollection]);
        }
        Session::flash('error', 'Cart empty!');
        return redirect()->route('shop');
    }
    public function cart()  {
        $cartCollection = \Cart::getContent();

        return view('frontend.cart')->withTitle('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);;
    }
    public function add(Request $request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
           'attributes' => array(
                'image' => $request->img,
                'slug' => $request->slug
   )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
    }

    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }
    public function clear(){
        \Cart::clear();
        return back()->with('success_msg', 'Car is cleared!');
    }

    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            ));
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }

}
