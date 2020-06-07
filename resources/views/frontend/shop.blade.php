@extends('layouts.frontend')
@section('contents')
    <div class="container" style="margin-top: 80px">
        @include('includes.flash_message')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Products In Our Store</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-3">
                            <div class="card" style="margin-bottom: 20px; height: auto;">
                                <img src="{{ $product->image_url }}"
                                     class="card-img-top mx-auto"
                                     style="height: 150px; width: 150px;display: block;"
                                     alt="{{ $product->image_url }}"
                                >
                                <div class="card-body">
                                    <a href=""><h6 class="card-title">{{ $product->title }}</h6></a>
                                    <p>${{ $product->price }}</p>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                                        <input type="hidden" value="{{ $product->title }}" id="name" name="name">
                                        <input type="hidden" value="{{ $product->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $product->image_url }}" id="img" name="img">
                                        <input type="hidden" value="{{ $product->slug }}" id="slug" name="slug">
                                        <input type="hidden" value="{{ $product->quantity }}" id="quantity" name="stock_quantity">
                                        <div class="product-btns">
                                            <div class="qty-input">
                                                <span class="text-uppercase">QTY: </span>
                                                <input class="input" type="number" name="quantity">
                                            </div>
                                            <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart" onclick="addToCart({{ $product->id }})"> </i> Add to Cart</button>
                                            <div class="pull-right">
                                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                                <button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
                                            </div>
                                        </div>

{{--                                        <div class="card-footer" style="background-color: white;">--}}
{{--                                            <div class="row">--}}
{{--                                                <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">--}}
{{--                                                    <i class="fa fa-shopping-cart"></i> add to cart--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                            <div class="product-btns">--}}
{{--                                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>--}}
{{--                                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>--}}
{{--                                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
