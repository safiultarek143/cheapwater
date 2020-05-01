@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="card card-info">
            <div class="card-header">
                <div class="row">
                    <h3 class="card-title">Categories</h3>


                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($categories->count())
                                @foreach($categories as $key => $productCategory)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $productCategory->name }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-info"
                                               href="{{ route('categories.edit',$productCategory->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @include('includes._confirm_delete',[
                                                'id' => $productCategory->id,
                                                'url' => route('categories.destroy',$productCategory->id),
                                                'message' => 'Are you sure want to delete this category?',
                                            ])
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
                    <div class="col-md-4">
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-outline-info float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

