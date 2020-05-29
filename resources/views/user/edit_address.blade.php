<div class="row">
    <form action="{{ route('userPanel') }}" method="post" id="checkout-form" class="clearfix">
        @csrf
        <div class="col-md-12">
            <div class="billing-details">
                <div class="section-title">
                    <h3 class="title">Shipping Address</h3>
                </div>
                <div class="form-group">
                    <input class="input" type="text" name="first_name" placeholder="First Name">
                </div>
                <div class="form-group">
                    <input class="input" type="text" name="last_name" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <input class="input" type="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input class="input" type="text" name="address" placeholder="Address">
                </div>
                <div class="form-group">
                    <input class="input" type="text" name="city" placeholder="City">
                </div>
                <div class="form-group">
                    <input class="input" type="text" name="country" placeholder="Country">
                </div>
                <div class="form-group">
                    <input class="input" type="text" name="zip" placeholder="ZIP Code">
                </div>
                <div class="form-group">
                    <input class="input" type="text" name="telephone" placeholder="Telephone">
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
