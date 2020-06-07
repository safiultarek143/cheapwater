@extends('layouts.user')
@section('content')
    <div class="row">
        <div class="container">
            @include('includes.flash_message')
            <div class="signup-form">
                <h2 class="title">Account Details</h2>
                <form action="{{ route('userAccount.update', $customer->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input class="input" type="text" name="first_name" value="{{$customer->first_name}}" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="last_name"value="{{$customer->last_name}}" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="email" name="email" value="{{$customer->email}}" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input class="input" type="password" name="current_password" placeholder="Current Password">
                    </div>
                    <div class="form-group">
                        <input class="input" type="password" name="password" placeholder=" new Password">
                    </div>
                    <div class="form-group">
                        <input class="input" type="password" name="password_confirmation" placeholder="confirm Password">
                    </div>
                    <button class="btn btn-sm btn-outline-info"type="submit">
                        <i class="fa fa-suitcase-rolling">save changes</i>
                    </button>
                </form>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection

