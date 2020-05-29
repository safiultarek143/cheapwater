@extends('layouts.user')
@section('content')
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
                                <th>Order Total</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                            </thead>
{{--                            @if($shipping->count())--}}
{{--                            @foreach($shipping as $key => $shipping)--}}
                                <tr>
                            <td>{{ $shipping->first_name }}</td>
                            <td>{{ $shipping->last_name }}</td>
                            <td>{{ $shipping->email }}</td>
                            <td>{{ $shipping->address }}</td>
                            <td>{{ $shipping->country }}</td>
                            <td>{{ $shipping->zip }}</td>
                            <td>{{ $shipping->telephone }}</td>
{{--                            <tbody>--}}
{{--                            @if($addresses->count())--}}
{{--                                @foreach($addresses as $key => $address)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $key + 1 }}</td>--}}
{{--                                        <td>{{ $address->first_name }}</td>--}}
{{--                                        <td>${{ $address->last_name }}.00</td>--}}
{{--                                        <td>{{ $address->email}}</td>--}}
{{--                                        <td>{{ $address->address}}</td>--}}
{{--                                        <td>{{ $address->city}}</td>--}}
{{--                                        <td>{{ $address->country}}</td>--}}
{{--                                        <td>{{ $address->zip}}</td>--}}
{{--                                        <td>{{ $address->telephone}}</td>--}}
{{--                                        <td>--}}
{{--                                            <a class="btn btn-sm btn-outline-info"--}}
{{--                                               href="{{ route('orders.show', $address->id) }}">--}}
{{--                                                <i class="fa fa-street-view"></i>--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                            </tbody>--}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



