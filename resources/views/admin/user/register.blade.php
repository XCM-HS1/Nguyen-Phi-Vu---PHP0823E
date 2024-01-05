<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Organi | Register</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('admin-theme/assets/img/favicon/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    @include('admin.layouts.css')
</head>
<body>
    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
              <div class="card card-registration my-4">
                <div class="row g-0">
                  <div class="col-xl-6 d-none d-xl-block">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                      alt="Sample photo" class="img-fluid"
                      style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                  </div>
                  <div class="col-xl-6">
                    <div class="card-body p-md-5 text-black">
                        <div class="d-flex">
                            <i class="fa-2x me-3 fa-solid fa-leaf" style="color: #29d31d;"></i>
                            <h3 class="mb-5 text-uppercase">Organi Registration </h3>
                        </div>

                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf

                            <div class="form-outline mb-4">
                                <input type="text" id="form3Example9" class="form-control form-control-lg" name="name" placeholder="Username" required/>
                                <label class="form-label" for="form3Example9">Username</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="tel" id="form3Example9" class="form-control form-control-lg" name="phone_number" maxlength="11" placeholder="(+84)" required/>
                                <label class="form-label" for="form3Example9">Phone Number</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="form3Example90" class="form-control form-control-lg" name="email" placeholder="Email" required/>
                                <label class="form-label" for="form3Example90">Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="form3Example99" class="form-control form-control-lg" name="password" placeholder="***************" required/>
                                <label class="form-label" for="form3Example99">Password</label>
                            </div>

                            <div class="d-flex justify-content-center mb-5">
                                <button type="submit" class="btn btn-success btn-lg ms-2">Register</button>
                            </div>
                        </form>

                        <p class="mb-2 pb-lg-2" style="color: #393f81;">Already have an account?
                            <a href="{{ route('user.login') }}" style="color: #393f81;">Login here</a>
                        </p>
                        <p class="mb-2 pb-lg-2" style="color: #393f81">
                            Login with socilaite!
                            @foreach(['google'] as $provider)
                            <a href="{{ route('social.login', ['provider' => $provider]) }}"><i class="fa-brands fa-xl fa-square-google-plus"></i></a>
                            @endforeach
                        </p>
                        <a href="#!" class="small text-muted">Terms of use.</a>
                        <a href="#!" class="small text-muted">Privacy policy</a>
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
