@extends('admin.app')

@section('content')

<form action="{{ route('admin.admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                <h5 class="card-header">Modify Admin Account</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                    <label for="html5-text-input" class="col-md-2 col-form-label">Name</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" id="html5-text-input" placeholder="Name" name="name" value="{{ $admin->name }}"/>
                    </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="html5-search-input" class="col-md-2 col-form-label">Password</label>
                    <div class="col-md-10">
                        <input class="form-control" type="password" id="html5-search-input" name="password" placeholder="Password" />
                    </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="html5-email-input" class="col-md-2 col-form-label">Email</label>
                    <div class="col-md-10">
                        <input class="form-control" type="email" id="html5-email-input" placeholder="example@gmail.com" name="email" value="{{ $admin->email }}" readonly/>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <h5 class="card-header">Modify Admin Avatar</h5>
                    <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Avatar</label>
                        <input class="form-control" type="file" id="formFile" name="avatar" />
                    </div>
                    @if ($admin->avatar == null)
                        <div class="mb-3">
                            <label for="formFile" class="form-label">None Avatar Founded</label>
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Current Avatar</label>
                            <img src="{{ asset('storage/' . $admin->avatar)}}" style="width: 150px">
                        </div>
                    @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.admin.index') }}">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
            </div>
        </div>
    </div>
</form>

@endsection
