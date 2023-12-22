@extends('admin.app')

@section('content')

<form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-6">
            <!-- HTML5 Inputs -->
                <div class="card mb-4">
                <h5 class="card-header">Modify User Account</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                    <label for="html5-text-input" class="col-md-2 col-form-label">Username</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" id="html5-text-input" placeholder="Username" name="name" value="{{ $user->name }}"/>
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
                        <input class="form-control" type="email" id="html5-email-input" placeholder="example@gmail.com" name="email" value="{{ $user->email }}" readonly/>
                    </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="html5-email-input" class="col-md-2 col-form-label">Phone Number</label>
                    <div class="col-md-10">
                        <input class="form-control" type="tel" id="html5-email-input" name="phone_number" value="{{ $user->phone_number }}" readonly/>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <h5 class="card-header">Modify User Avatar</h5>
                    <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Avatar</label>
                        <input class="form-control" type="file" id="formFile" name="user_avatar" />
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Current Avatar</label>
                        <img src="{{ asset('storage/' . $user->user_avatar)}}" style="width: 150px">
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.user.index') }}">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
            </div>
        </div>
    </div>
</form>

@endsection
