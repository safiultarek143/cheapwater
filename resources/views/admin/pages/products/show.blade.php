@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <div class="row">

                    <div class="col-md-6">
                        <h3 class="card-title">View Product</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-warning float-right">
                            <i class="fa fa-arrow-left"></i> Back TO Index
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <p><b>Title:</b>{{$products->title}}</p><br><br>
                        <p><b>Description:</b>{!! $products->description !!}</p><br><br>
{{--                        <p><b>Category:</b>{{ $products->category->name }}</p><br><br>--}}
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <br>
                            <input type="hidden" name="old_image" value="{{ $products->thumbnail_url }}">
                            <img src="{{ $products->image_url }}" alt="" height="50px" width="50px">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.forms['editPostForm'].elements['category_id'].value='{{ $products->category_id }}';
    </script>
@stop


