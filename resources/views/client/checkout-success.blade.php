<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Checkout | Success</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('admin-theme/assets/img/favicon/favicon.ico') }}" />

    <!-- Google Font -->
    @include('client.layouts.font')

    <!-- Css Styles -->
    @include('client.layouts.css')
</head>

<body>
    <!-- Page Preloder -->
    @include('client.layouts.preload')

    <!-- Humberger Begin -->
    @include('client.layouts.humberger')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
   @include('client.layouts.header')
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    @include('client.layouts.hero')
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('client-theme/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('client.home') }}">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Success Message Begin -->
        <section class="checkout spad">
            <div class="container">
                <div class="checkout__form">
                    <h4>Dear, {{ Auth::user()->name }}</h4>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Thank You For Shopping At Ogani!</h2>
                            <br>
                            <h4>Please wait a few days for delivery!</h4>
                            <h5 class="mt-5">In The Meantime, Checkout More Products At Our Shop!</h5>
                            <a href="{{route('client.shop')}}" class="btn btn-warning mt-5">Shop Now</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    <!-- Checkout Success Message End -->

    <!-- Footer Section Begin -->
    @include('client.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('client.layouts.js')
</body>

</html>
