@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <div class="row">

                    <div class="col-md-6">
                        <h3 class="card-title">Edit Product</h3>
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
                        <form action="{{route('products.update',$products->id)}}" method="post" enctype="multipart/form-data" name="editPostForm">
                            @csrf @method('put')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title',$products->title) }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="summernote" cols="30" rows="10">{{ old('description',$products->description) }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Category</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="">Choose category</option>
                                    @if($Product_categories->count())
                                        @foreach($Product_categories as $productCategory)
                                            <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input name="price" type="text" placeholder="Price"class="form-control @error('price') is-invalid @enderror" value="{{ old('price',$products->price) }}">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantity</label>
                                <input name="quantity" type="number" placeholder="Quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity',$products->quantity) }}">
                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="thumbnail">Old Thumbnail</label>
                                <br>
                                <input type="hidden" name="old_image" value="{{ $products->image }}">
                                <img src="{{ $products->image_url }}" alt="" height="50px" width="50px">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <br>
                                <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror">
                                @error('image')
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
    <script>
        document.forms['editPostForm'].elements['category_id'].value='{{ $products->category_id }}';
    </script>
@stop

