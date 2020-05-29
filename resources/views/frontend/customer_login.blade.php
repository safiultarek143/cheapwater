@extends('layouts.frontend')
@section('contents')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="billing-details">
                        <h2 class="title">Login to your account</h2>
                        @if(Session::has('message'))
                            <h3 class="text-danger text-center">{{ Session::get('message') }}</h3>
                        @endif
                        <form action="{{ route('customer.login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input class="input" type="email" name="email" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input class="input" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-1">
                    <h2 class="mt-5">OR</h2>
                </div>
                <div class="col-md-6">
                    <div class="signup-form">
                        <h2 class="title">New User Signup!</h2>
                        <form action="{{ route('customer.register') }}" method="post">
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
                            <div class="form-group">
                                <input type="submit" value="Create an account">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

