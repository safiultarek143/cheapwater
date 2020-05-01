@extends('layouts.frontend')
@section('contents')

    <!-- Start Main Banner -->

    <!-- End Main Banner -->
    @include('frontend.nav')
    <!-- Start Welcome Area -->
    @include('frontend.home')

    @include('frontend.hot_deal')

    @include('frontend.new_collection')

    @include('frontend.latest_product')




@stop
