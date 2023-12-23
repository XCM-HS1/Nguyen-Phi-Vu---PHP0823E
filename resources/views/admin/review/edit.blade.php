@extends('admin.app')

@section('content')

<form action="{{ route('admin.review.proceed') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{$review->id}}" name="id">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                <h5 class="card-header">User Review Product
                    @if($review->status == 1)
                    <span class="badge bg-warning"> Rated/Not Verified </span>
                    @elseif($review->status == 2)
                    <span class="badge bg-success"> Rated </span>
                    @endif
                </h5>
                <div class="card-body">
                    <div class="mb-3 row">
                        <p>User ID: {{$review->user_id}}</p>
                        <p>Username: {{$review->user_name}}</p>
                        <p>Order ID: {{$review->order_id}} </p>
                        <p>Product ID: {{$review->product_id}}</p>
                        <p>Product Name: {{$review->product_name}}</p>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                <h5 class="card-header">User Review Content</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                    <label for="html5-text-input" class="col-md-2 col-form-label">User Review</label>
                    <div class="col-md-10">
                        <input id="input" value="{!! $review->review !!}" name="review"/>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 mb-4">
                <div class="card">
                    <h5 class="card-header">User Rating</h5>
                    <div class="card-body">
                    <div class="mb-3">
                        <div>
                            @switch($review->rating)
                                @case(0.5)
                                    <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    @break
                                @case(1)
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    @break
                                @case(1.5)
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    @break
                                @case(2)
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    @break
                                @case(2.5)
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    @break
                                @case(3)
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    @break
                                @case(3.5)
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    @break
                                @case(4)
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                    @break
                                @case(4.5)
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                    @break
                                @default
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                    @break
                            @endswitch
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>

        @if(! $review->image == null)
        <div class="row">
            <div class="col-xl-6 mb-4">
                <div class="card">
                    <h5 class="card-header">User Review Picture</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $review->image)}}" style="width: 150px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($review->status == 1)
        <div class="col-xl-6">
            <button type="submit" class="btn btn-primary">Proceed</button>

            <a href="{{ route('admin.review.index') }}">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </div>

    </div>
</form>

<div class="row">
    <div class="col-xl-12">
        @elseif($review->status == 2)
        <form action="admin.review.destroy" method="POST">
            <div class="col-xl-6">
                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="{{ route('admin.review.index') }}">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
            </div>
        </form>
        @endif
    </div>
</div>

@section('admin-js')
@include('components.head.tinymce-config')
@endsection

@endsection
