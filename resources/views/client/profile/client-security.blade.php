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

    <title>Account Security | {{$user->name}}</title>

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
              <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Account Security /</span> {{$user->name}}
              </h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.account', $user->id)}}"
                        ><i class="bx bx-user me-1"></i> Account</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href=""
                        ><i class="bx bx-lock-alt me-1"></i> Security</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.purchase.history', $user->id)}}"
                        ><i class="bx bx-history me-1"></i> Purchase History</a
                      >
                    </li>
                  </ul>

                  <div class="card">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{route('user.change.password')}}" method="POST">
                                @csrf

                                <div class="mb-3 form-password-toggle col-md-6">
                                    <label class="form-label">Current Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="current_password" minlength="6" required/>
                                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>

                                <div class="mb-3 form-password-toggle col-md-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="password" minlength="6" required/>
                                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>

                                <div class="mb-3 form-password-toggle col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="password_confirm" minlength="6" required/>
                                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <button type="submit" class="btn btn-primary">Save Change</button>

                                    <a href="{{route('client.home')}}">
                                        <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
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

    @include('admin.layouts.js')
  </body>
</html>
