@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="container">
            <div class="card-header">
                <h4>Customer Details</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    @if(!empty($order->customer))
                        <tr>
                            <th>Customer Email</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order->customer->first_name.' '.$order->customer->last_name}}</td>
                        <td>{{$order->customer->email}}</td>
                    </tr>
                    @else
                        <tr>
                            <td>Guest</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container">
            <div class="card-header">
                <h4>Shipping Details</h4>
            </div>
            <div class="card-body">
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
                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div><!--/row-->
    <div class="row">
        <div class="container">
            <div class="card-header">
                <h4>Order Details</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped ">
                    <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Product name</th>
                        <th>Product price</th>
                        <th>Product sales quantity</th>
                        <th>Product sub total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetails as $orderDetail)
                        <tr>
                            <td>{{$orderDetail->order_id}}</td>
                            <td>{{$orderDetail->product_name}}</td>
                            <td>${{$orderDetail->product_price}}</td>
                            <td>{{$orderDetail->product_sales_quantity}}</td>
                            <td>${{ $orderDetail->product_price * $orderDetail->product_sales_quantity }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4">Total: </td>
                        <td><strong>= ${{$total_sum}}</strong></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection
