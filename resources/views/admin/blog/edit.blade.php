@extends('admin.app')

@section('content')

<form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                <h5 class="card-header">Modify Title</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Current Title</label>
                        <div class="col-md-10">
                            <input class="form-control" value="{{ $blog->title }}" readonly />
                        </div>
                        <label for="html5-text-input" class="col-md-2 col-form-label">New Title</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="title" value="{{ $blog->title }}"/>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="card mb-4">
                <h5 class="card-header">Modify Content</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">Current Content</label>
                        <div class="col-md-10">
                            <p>{!! $blog->content !!}</p>
                        </div>
                        <label for="html5-search-input" class="col-md-2 col-form-label">New Content</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="content" name="content" value="{!! $blog->content !!}"></textarea>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Modify Blog Images</h5>
                    <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Images</label>
                        <input class="form-control" type="file" id="formFile" name="image" />
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Current Images</label>
                        <img src="{{ asset('storage/' . $blog->image)}}" style="width: 150px">
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Modify Tag</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Tags</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="tag">
                                @foreach($tags_data as $tag1)
                                    <option value="{{$tag1->id}}">{{$tag1->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.blog.index') }}">
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
