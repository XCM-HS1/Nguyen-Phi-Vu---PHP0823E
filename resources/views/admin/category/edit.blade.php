@extends('admin.app')

@section('content')

<form action="{{ route('admin.category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-8">
            <!-- HTML5 Inputs -->
                <div class="card mb-4">
                <h5 class="card-header">Modify Product's Category</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Current Category Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{ $category->category }}" readonly/>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">New Category Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="category" required/>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-xl-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.category.index') }}">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
            </div>
        </div>
    </div>

</form>

@endsection
