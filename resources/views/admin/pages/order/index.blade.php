@extends('layouts.admin')
@section('content')
    <div class="col-md-12">
        @include('includes.flash_message')
        <div class="card card-info">
            <div class="card-header">
                <div class="row">
                    <h3 class="card-title">Orders</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Order Total</th>
                                <th>Payment method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($orders->count())
                                @foreach($orders as $key => $order)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer_id == false? 'Guest' : $order->customer->first_name.' '.$order->customer->last_name }}</td>
                                        <td>${{ $order->total }}.00</td>
                                        <td>{{ $order->payment->payment_method }}</td>
                                        <td>{{ $order->status == false? 'Pending' : '' }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-info"
                                               href="{{ route('orders.show', $order->id) }}">
                                                <i class="fa fa-street-view"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


