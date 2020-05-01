@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <div class="row">

                    <div class="col-md-6">
                        <h3 class="card-title">Edit Category</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-warning float-right">
                            <i class="fa fa-arrow-left"></i> Back TO Index
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form action="{{ route('categories.update',$productCategory->id) }}" method="post">
                            @csrf @method('put')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$productCategory->name) }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-outline-info float-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
