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
            <form action="{{ route('order.place') }}" method="post" id="checkout-form" class="clearfix">
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
                            <label class="form-check-label" for="billtoship">Ship to a different Address ?</label>
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
                            <input type="radio" name="payment_method" value="card" id="payments-1" checked>
                            <label for="payments-1">Credit Card - Visa, MasterCard & Any Major Credit Card</label>
                            <div class="form-group">
                                <input class="input" type="number" name="card_number" placeholder="Credit card number">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <select name="exp_month" id="" class="form-control" required>
                                            @for($i=1; $i<=12; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        /
                                    </div>
                                    <div class="col-md-5">
                                        <select name="exp_year" id="" class="form-control" required>
                                            @for($i=0; $i<=10; $i++)
                                                <option value="{{ date('Y') + $i }}">{{ date('Y') + $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="input" type="number" name="cvv" placeholder="Card (CVV) Code" required>
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
                                <th colspan="2" class="sub-total">${{ \Cart::getSubTotal() }}</th>
                            </tr>
                            <tr>
                                <th class="empty" colspan="3"></th>
                                <th>SHIPING</th>
                                <td colspan="2"><input type="radio" name="shipping" value="" id="payments-1" checked>&nbsp;Free shipping</td>
                                <td colspan="2"><input type="radio" name="shipping" value="45" id="payments-1" >&nbsp;Overnight Shipping</td>
                                <td colspan="2"><input type="radio" name="shipping" value="20" id="payments-1" >&nbsp;2 days Shipping</td>
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


