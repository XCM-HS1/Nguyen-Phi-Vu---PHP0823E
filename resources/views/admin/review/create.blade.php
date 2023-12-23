@extends('admin.app')

@section('content')

<form action="{{ route('admin.admin.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-6">
            <!-- HTML5 Inputs -->
                <div class="card mb-4">
                <h5 class="card-header">Create Admin Account</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                    <label for="html5-text-input" class="col-md-2 col-form-label">Name</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" id="html5-text-input" placeholder="Name" name="name" required/>
                    </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="html5-search-input" class="col-md-2 col-form-label">Password</label>
                    <div class="col-md-10">
                        <input class="form-control" type="password" id="html5-search-input" name="password" placeholder="Password" required/>
                    </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="html5-email-input" class="col-md-2 col-form-label">Email</label>
                    <div class="col-md-10">
                        <input class="form-control" type="email" id="html5-email-input" placeholder="example@gmail.com" name="email" required/>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <h5 class="card-header">Upload Admin Avatar</h5>
                    <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Avatar</label>
                        <input class="form-control" type="file" id="formFile" name="avatar"/>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.admin.index') }}">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
            </div>
        </div>
    </div>
</form>

@endsection
