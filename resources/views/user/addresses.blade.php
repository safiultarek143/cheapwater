@extends('layouts.user')
@section('content')
    <div class="row">
{{--        <div class="container">--}}
{{--            <div class="card-header">--}}
{{--                <h4>Customer Details</h4>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <table class="table">--}}
{{--                    <thead>--}}
{{--                    @if(!empty($order->customer))--}}
{{--                        <tr>--}}
{{--                            <th>Customer Email</th>--}}
{{--                            <th>Email</th>--}}
{{--                        </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <td>{{$billing>customer->first_name.' '.$order->customer->last_name}}</td>--}}
{{--                        <td>{{$billing->customer->email}}</td>--}}
{{--                    </tr>--}}
{{--                    @else--}}
{{--                        <tr>--}}
{{--                            <td>Guest</td>--}}
{{--                        </tr>--}}
{{--                    @endif--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
        </div>
        <div class="container col-md-12">
            <div class="card-header">
                <h4>Billing Details</h4>
            </div>
            <div class="card-body col-md-6">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Zip</th>
                        <th>Telephone</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order->billing->first_name.' '.$order->billing->last_name}}</td>
                        <td>{{$order->billing->email}}</td>
                        <td>{{$order->billing->address}}</td>
                        <td>{{$order->billing->city}}</td>
                        <td>{{$order->billing->country}}</td>
                        <td>{{$order->billing->zip}}</td>
                        <td>{{$order->billing->telephone}}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-info"
                               href="{{ route('userBilling.address',$order->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-header col-6">
                <h4>Shipping Details</h4>
            </div>
            <div class="card-body col-md-6">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Zip</th>
                        <th>Telephone</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order->shipping->first_name.' '.$order->shipping->last_name}}</td>
                        <td>{{$order->shipping->email}}</td>
                        <td>{{$order->shipping->address}}</td>
                        <td>{{$order->shipping->city}}</td>
                        <td>{{$order->shipping->country}}</td>
                        <td>{{$order->shipping->zip}}</td>
                        <td>{{$order->shipping->telephone}}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-info"
                               href="{{ route('userShipping.address',$order->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
{{--    </div><!--/row-->--}}
    </div>
@stop



