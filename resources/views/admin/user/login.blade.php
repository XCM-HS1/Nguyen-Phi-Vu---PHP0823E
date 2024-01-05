<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Organi | Login</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('admin-theme/assets/img/favicon/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    @include('admin.layouts.css')
</head>
<body>
    <section class="vh-100" style="background-color: rgb(69, 120, 50);">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">

                      <form action="{{ route('user.pLogin') }}" method="POST">
                        @csrf

                        <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fa-2x me-3 fa-solid fa-leaf" style="color: #29d31d;"></i>
                          <span class="h1 fw-bold mb-0">Organi Login</span>
                        </div>

                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                        <div class="form-outline mb-4">
                          <input type="email" id="form2Example17" class="form-control form-control-lg" name="email" placeholder="Email"/>
                          <label class="form-label" for="form2Example17">Email</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" placeholder="***************"/>
                          <label class="form-label" for="form2Example27">Password</label>
                        </div>

                        <div class="pt-1 mb-5 d-flex justify-content-center">
                          <button class="btn btn-success btn-lg" type="submit">Login</button>
                        </div>

                        {{-- <a class="small text-muted" href="#!">Forgot password?</a> --}}
                        <p class="mb-2 pb-lg-2" style="color: #393f81">
                            Login with socilaite!
                            @foreach(['google'] as $provider)
                            <a href="{{ route('social.login', ['provider' => $provider]) }}"><i class="fa-brands fa-xl fa-square-google-plus"></i></a>
                            @endforeach
                        </p>

                        <p class="mb-3 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="{{ route('user.register') }}"
                            style="color: #393f81;">Register here</a></p>

                        <a href="#!" class="small text-muted">Terms of use.</a>
                        <a href="#!" class="small text-muted">Privacy policy</a>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      @include('admin.layouts.js')
</body>
</html>

