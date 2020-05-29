@extends('layouts.frontend')
@section('contents')
<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{'/'}}">Home</a></li>
            <li class="active">Checkout</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
    @include('includes.flash_message')
        <!-- row -->
        <div class="row">
            <form action="{{ route('userPanel') }}" method="post" id="checkout-form" class="clearfix">
                @csrf
                <div class="col-md-6">
                    <div class="billing-details">
                        @if(Session::get('customer'))
                            <p>{{ Session::get('customer')['customerName'] }} ({{ Session::get('customer')['email'] }}) <a href="{{ route('customer.logout') }}" class="text-blue">Logout</a></p>
                        @else
                            <p>Already a customer ? <a href="{{ route('customer.login_form') }}">Login</a></p>
                        @endif
                        <div class="section-title">
                            <h3 class="title">Billing Address</h3>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="b_first_name" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="b_last_name" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" name="b_email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="b_address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="b_city" placeholder="City">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="b_country" placeholder="Country">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="b_zip" placeholder="ZIP Code">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="b_telephone" placeholder="Telephone">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <div class="input-checkbox">--}}
{{--                                <input type="checkbox" id="register">--}}
{{--                                <label class="font-weak" for="register">Create Account?</label>--}}
{{--                                <div class="caption">--}}
{{--                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.--}}
{{--                                    <p>--}}
{{--                                        <input class="input" type="password" name="password" placeholder="Enter Your Password">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="form-group" style ="margin-left:30px">
                            <input type ="checkbox" onclick="showShipping(event)" class="from-check-input" id="billtoship">
                            <label class="form-check-label" for="billtoship">shipping Address Same As billing Address</label>
                        </div>
                    </div>
                    <div class="d-none" id="shipping-show">
                    <div class="section-title">
                        <h3 class="title">Shipping Address</h3>
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="s_first_name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="s_last_name" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="email" name="s_email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="s_address" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="s_city" placeholder="City">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="s_country" placeholder="Country">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="s_zip" placeholder="ZIP Code">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="s_telephone" placeholder="Telephone">
                    </div>
                    </div>
                    <div class="payments-methods">
                        <div class="section-title">
                            <h4 class="title">Payments Methods</h4>
                        </div>
                        <div class="input-checkbox">
                            <input type="radio" name="payment_method" value="Bank Transfer"id="payments-1" checked>
                            <label for="payments-1">Direct Bank Transfer</label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                <p>
                            </div>
                        </div>
                        <div class="input-checkbox">
                            <input type="radio" name="payment_method" value="Cheque" id="payments-2">
                            <label for="payments-2">Cheque Payment</label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                <p>
                            </div>
                        </div>
                        <div class="input-checkbox">
                            <input type="radio" name="payment_method" value="paypal" id="payments-3">
                            <label for="payments-3">Paypal System</label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                <p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Order Review</h3>
                    </div>
                    @if(\Cart::getTotalQuantity()>0)
                        <h4>{{ \Cart::getTotalQuantity()}} Product(s) In Your Cart</h4><br>
                    @else
                        <h4>No Product(s) In Your Cart</h4><br>
                        <a href="/" class="btn btn-dark">Continue Shopping</a>
                    @endif
                </div>
                    <div class="order-summary clearfix">

                        <table class="shopping-cart-table table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Product Image</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                                <th class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartCollection as $item)
                            <tr>
                                <td class="thumb"><img src="{{ $item->attributes->image }}" alt=""></td>
                                <td class="details">
                                    <a href="#">{{ $item->name }}</a>

                                </td>
                                <td class="price text-center"><strong>${{ $item->price }}</strong><br><del class="font-weak"><small>$40.00</small></del></td>
                                <td class="qty text-center"><input class="input" type="number" value="{{ $item->quantity }}"></td>
                                <td class="total text-center"><strong class="primary-color">${{ \Cart::get($item->id)->getPriceSum() }}</strong></td>
                                <td class="text-right"><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></td>
                            </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="empty" colspan="3"></th>
                                <th>SUBTOTAL</th>
                                <th colspan="2" class="sub-total">${{ \Cart::getTotal() }}</th>
                            </tr>
                            <tr>
                                <th class="empty" colspan="3"></th>
                                <th>SHIPING</th>
                                <td colspan="2">Free Shipping</td>
                            </tr>
                            <tr>
                                <th class="empty" colspan="3"></th>
                                <th>TOTAL</th>
                                <th colspan="2" class="total">${{ \Cart::getTotal() }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="pull-right">
                            <button class="primary-btn">Place Order</button>
                        </div>
                    </div>
                    </form>
                     <hr>
                </div>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        function showShipping(e) {
            e.preventDefault();
           let shipping = $('#shipping-show');
           if(shipping.hasClass('d-none')){
               shipping.removeClass('d-none');
           } else{
               shipping.addClass('d-none');
           }

        }
    </script>
@endpush


