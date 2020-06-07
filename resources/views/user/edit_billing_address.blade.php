@extends('layouts.user')
@section('content')
    <div class="row">
        <div class="container">
            @include('includes.flash_message')
            <div class="signup-form">
                <h2 class="title">Billing Address</h2>
                <form action="{{ route('userBilling.updateAddress', $order->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input class="input" type="text" name="first_name"value="{{$order->billing->first_name}}" placeholder="first Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="last_name"value="{{$order->billing->last_name}}" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="email"value="{{$order->billing->email}}" placeholder="email">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="address"value="{{$order->billing->address}}" placeholder="address">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="city" value="{{$order->billing->city}}" placeholder="city">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="country" value="{{$order->billing->country}}"placeholder="country">
                    </div>
                    <div class="form-group">
                        <input class="input" type="number" name="zip" value="{{$order->billing->zip}}"placeholder=" zip">
                    </div>
                    <div class="form-group">
                        <input class="input" type="number" name="telephone" value="{{$order->billing->telephone}}" placeholder="telephone">
                    </div>
                    <button class="btn btn-sm btn-outline-info"type="submit">
                        <i class="fa fa-suitcase-rolling">save changes</i>
                    </button>
                </form>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection
