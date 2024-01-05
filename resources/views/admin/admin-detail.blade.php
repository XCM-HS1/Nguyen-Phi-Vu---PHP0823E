<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Admin | Account</title>

    <meta name="description" content="" />

    @include('admin.layouts.css')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        @include('admin.layouts.sidebar')

        <!-- Layout container -->
        <div class="layout-page">
            @include('admin.layouts.navbar')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->

                    <form id="formAccountSettings" method="POST" enctype="multipart/form-data" action="{{route('admin.profile.update', $admin->id)}}">
                        @csrf
                        <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img
                                @if($admin->avatar == null)
                                src="{{ asset('admin-theme/assets/img/avatars/default-admin.png') }}"
                                @else
                                src="{{ asset('storage/' . $admin->avatar)}}"
                                @endif
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar"
                                />

                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Change Avatar</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                    type="file"
                                    class="account-file-input"
                                    id="upload"
                                    hidden
                                    onchange="loadFile(event)"
                                    name="avatar"
                                    />
                                </label>

                                <a href="">
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>
                                </a>
                        </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">User Name</label>
                                <input class="form-control" type="text" name="name" value="{{$admin->name}}" />
                            </div>

                            <div class="mb-3 col-md-6"></div>

                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Email</label>
                                <input class="form-control" type="email" name="email" value="{{$admin->email}}" />
                            </div>

                            <div class="mb-3 col-md-6"></div>

                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Password</label>
                                <input class="form-control" type="password" name="password" value="{{$admin->password}}" />
                            </div>

                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <a href="{{route('admin.home')}}">
                                <button type="button" class="btn btn-outline-secondary">Cancel</button>
                            </a>
                            </div>
                        </div>

                    </form>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('uploadedAvatar');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    @include('admin.layouts.js')
  </body>
</html>
