@extends('admin.app')

@section('content')

<form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">
            <!-- HTML5 Inputs -->
                <div class="card mb-4">
                <h5 class="card-header">Create Blog</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="title" required/>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Content</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="content" name="content" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="exampleFormControlSelect1" class="form-label">Select Tag</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="tag">
                            @foreach($tags_data as $tag1)
                                <option value="{{$tag1->id}}">{{$tag1->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-xl-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Upload Blog's Images</h5>
                    <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Images</label>
                        <input class="form-control" type="file" id="formFile" name="image"/>
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

