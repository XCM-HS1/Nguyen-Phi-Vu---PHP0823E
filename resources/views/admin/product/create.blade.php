@extends('admin.app')

@section('content')

<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                <h5 class="card-header">Create Product</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Product Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="product_name" placeholder="Product Name" required/>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Product Price</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                                <input type="number" class="form-control" placeholder="Product Price" name="price" required/>
                                <span class="input-group-text">$</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Product Weight</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-scale-balanced"></i></i></span>
                                <input type="double" class="form-control" placeholder="Product Weight" name="weight" required/>
                                <span class="input-group-text">KG</span>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="availability" value="1" />

                    <div class="mb-3 row">
                        <div class="col-md-10">
                            <label for="exampleFormControlSelect1" class="form-label">Select Category</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="category">
                                @foreach($categories_data as $category)
                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-xl-6 mb-4">
                <div class="card">
                    <h5 class="card-header">Upload Product's Images</h5>
                    <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Images</label>
                        <input class="form-control" type="file" id="formFile" name="image" />
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Product Content</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Product Description</label>
                            <div class="col-md-10">
                                <textarea name="description" id="content" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-xl-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.product.index') }}">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
            </div>
        </div>
    </div>
</form>

@endsection

@section('admin-js')
@include('components.head.tinymce-config')
@endsection
