
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

    <title>Account | {{$user->name}}</title>

    <meta name="description" content="" />

    @include('admin.layouts.css')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> {{$user->name}}</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href=""><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.security', $user->id)}}"
                        ><i class="bx bx-lock-alt me-1"></i> Security</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.purchase.history', $user->id)}}"
                        ><i class="bx bx-history me-1"></i> Purchase History</a
                      >
                    </li>
                  </ul>

                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <form id="formAccountSettings" method="POST" enctype="multipart/form-data" action="{{route('user.update', $user->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if($user->user_avatar !== null)
                                <img
                                src="{{ asset('storage/' . $user->user_avatar)}}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar"
                                />
                                @else
                                <img
                                src="{{ asset('admin-theme/assets/img/avatars/default-customer.png')}}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar"
                                />
                                @endif

                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Change Avatar</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                    type="file"
                                    class="account-file-input"
                                    id="upload"
                                    hidden
                                    onchange="loadFile(event)"
                                    name="user_avatar"
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
                                <input class="form-control" type="text" name="name" value="{{$user->name}}" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Email</label>
                                <input class="form-control" type="email" name="email" value="{{$user->email}}" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Phone Number</label>
                                <input class="form-control" type="tel" maxlength="11" name="phone" value="{{$user->phone_number}}" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Address</label>
                                <input class="form-control" type="text" name="address" value="{{$user->address}}" />
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <a href="{{route('client.home')}}">
                                    <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </form>
                    </div>
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

    <div class="buy-now">
      <a
        href="{{route('client.shop')}}"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Shop Now</a
      >
    </div>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('uploadedAvatar');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    @include('admin.layouts.js')
  </body>
</html>
