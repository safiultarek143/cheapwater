@if(Session::has('success'))
    <div class="alert alert-success text-center  animated-alert">
        <div id="flash-notice"><b>{{ Session::get('success') }}</b></div>
    </div>
@endif
@if(Session::has('status'))
    <div class="alert alert-success text-center  animated-alert">
        <div id="flash-notice"><b>{{ Session::get('status') }}</b></div>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger text-center  animated-alert">
        <div id="flash-notice"><b>{{ Session::get('error') }}</b></div>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
