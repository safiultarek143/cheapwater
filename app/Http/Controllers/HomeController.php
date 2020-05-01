<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('welcome',compact('products'));
    }
    public function singleProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('frontend.product_page', compact('product'));
    }
}
