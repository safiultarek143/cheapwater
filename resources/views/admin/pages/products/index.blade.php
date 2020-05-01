@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card card-info">
            <div class="card-header">
                <div class="row">
                    <h3 class="card-title">Products</h3>
                    <div class="col-md-6">
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-warning float-right">
                            <i class="fa fa-plus"></i> Add New Product
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Title</th>
                                {{--                                <th>Description</th>--}}
                                <th>Category</th>
                                <th>Image</th>
                                <th>Created date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($products->count())
                                @foreach($products as $key => $Products)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $Products->title }}</td>
{{--                                        <td>{!! Illuminate\Support\Str::limit($Products->description, 100) !!}</td>--}}
                                        <td>{{ $Products->category->name }}</td>
                                        <td><img src="{{ $Products->image_url }}" alt="" height="50px" width="50px"></td>
                                        <td>{{ $Products->created_at }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-info"
                                               href="{{ route('products.edit',$Products->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @include('includes._confirm_delete',[
                                                'id' => $Products->id,
                                                'url' => route('products.destroy',$Products->id),
                                                'message' => 'Are you sure want to delete this Post?',
                                            ])
                                            <a class="btn btn-sm btn-outline-info"
                                               href="{{ route('products.show',$Products->id) }}">
                                                <i class="fa fa-street-view"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>SI</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


