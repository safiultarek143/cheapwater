@extends('layouts.user')
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
{{--                    @else--}}
{{--                        <tr>--}}
{{--                            <td>Guest</td>--}}
{{--                        </tr>--}}
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--/row-->
    <div class="row">
        <div class="container">
            <div class="card-header">
                <h4>Order Details</h4>
            </div>
            <div class="signup-form">
                <h2 class="title">Account Details</h2>
                <form action="#" method="post">
                    @csrf
                    <div class="form-group">
                        <input class="input" type="text" name="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="last_name" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input class="input" type="password" name="password" placeholder="Password">
                    </div>

                </form>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection

