@extends('layouts.frontend')
@section('contents')
    @include('includes.flash_message')

    @include('.frontend.nav')

    @include('frontend.home')

    @include('frontend.hot_deal')

    @include('frontend.new_collection')

    @include('frontend.latest_product')


@stop
