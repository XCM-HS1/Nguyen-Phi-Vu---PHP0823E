@extends('admin.app')

@section('content')

<form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Modify Product Name</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Current Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" value="{{ $product->product_name }}" readonly/>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">New Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="product_name" placeholder="New Product Name" value="{{ $product->product_name }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mb-4">
                <div class="card">
                    <h5 class="card-header">Modify Product Price</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Current Price</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                                    <input type="number" class="form-control" value="{{ $product->price }}" readonly/>
                                    <span class="input-group-text">.000₫</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">New Price</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                                    <input type="number" class="form-control" placeholder="Product Price" value="{{ $product->price }}" name="price"/>
                                    <span class="input-group-text">.000₫</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mb-4">
                <div class="card">
                    <h5 class="card-header">Modify Product Weight</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Current Weight</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-scale-balanced"></i></i></span>
                                    <input type="number" class="form-control" readonly value="{{ $product->weight }}"/>
                                    <span class="input-group-text">KG</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">new Weight</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-scale-balanced"></i></i></span>
                                    <input type="number" class="form-control" name="weight" placeholder="Product Weight" value="{{ $product->weight }}"/>
                                    <span class="input-group-text">KG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mb-4">
                <div class="card">
                    <h5 class="card-header">Modify Product Availability</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Current Availability</label>
                            <div class="col-md-10">
                                @if($product->availability == 0)
                                    <input class="form-control" type="text" value="Out Of Stock" readonly/>
                                @else
                                    <input class="form-control" type="text" value="In Stock" readonly/>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-10">
                                <label for="html5-text-input" class="col-md-2 col-form-label">Availability</label>
                                <div class="form-check mt-3 form-check-inline">
                                    <input type="radio" name="availability" class="form-check-input" value="0" id="defaultRadio1" />
                                    <label for="defaultRadio1" class="form-check-label">Out Of Stock</label>
                                </div>
                                <div class="form-check mt-3 form-check-inline">
                                    <input type="radio" name="availability" class="form-check-input" value="1" id="defaultRadio2" />
                                    <label for="defaultRadio2" class="form-check-label">In Stock</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mb-4">
                <div class="card">
                    <h5 class="card-header"></h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-10">
                                <label for="exampleFormControlSelect1" class="form-label">Change Category</label>
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
                            <label for="formFile" class="form-label">Select Image</label>
                            <input class="form-control" type="file" id="formFile" name="image"/>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Current Image</label>
                            <img src="{{ asset('storage/' . $product->image)}}" style="width: 150px">
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Product Content</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Current Description</label>
                            <div class="col-md-10">
                                <p>{!! $product->description !!}</p>
                                <input type="hidden" value="{{ $product->description }}" name="description_backup">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Product Content</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Change Description</label>
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
