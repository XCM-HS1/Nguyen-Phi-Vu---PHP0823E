<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @foreach($categories as $category1)
    <title>Ogani | Shop | Category | {{$category1->category}}</title>
    @endforeach
    <link rel="icon" type="image/x-icon" href="{{ asset('admin-theme/assets/img/favicon/favicon.ico') }}" />

    <!-- Google Font -->
    @include('client.layouts.font')

<!-- Css Styles -->
    @include('client.layouts.css')

</head>

<body>
    <!-- Page Preloader -->
    {{-- @include('client.layouts.preload') --}}


    <!-- Humberger Begin -->
    @include('client.layouts.humberger')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> ogani.customerservice@gmail.com</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>

                            <div class="header__top__right__language">
                                <img src="{{ asset('client-theme/img/language.png') }}" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            @if(!Auth::user())
                            <div class="header__top__right__auth">
                                <a href="{{route('user.login')}}"><i class="fa fa-user"></i> Login</a>
                            </div>
                            |
                            <div class="header__top__right__auth">
                                <a href="{{route('user.register')}}"><i class="fa fa-user-plus"></i> Register</a>
                            </div>
                            @else
                            @foreach($user_data as $user)
                            <div class="header__top__right__language">
                                @if($user->user_avatar == null)
                                <img src="{{ asset('admin-theme/assets/img/avatars/default-customer.png') }}" style="width: 30px">
                                @else
                                <img src="{{ asset('storage/' . $user->user_avatar) }}" style="width: 30px">
                                @endif
                                <div>{{Auth::user()->name}}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="{{route('user.account', $user->id)}}">Edit Profile</a></li>
                                    <li><a href="{{route('user.logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                </ul>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ route('client.home') }}"><img src="{{ asset('client-theme/img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{ route('client.home') }}">Home</a></li>
                            <li class="active"><a href="{{ route('client.shop') }}">Shop</a></li>
                            <li><a href="{{route('client.blog')}}">Blog</a></li>
                            <li><a href="{{route('client.contact')}}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    @if(Auth::user())
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{route('client.wishlist')}}"><i class="fa fa-heart"></i> <span>{{ $wishlistAuth->count() }}</span></a></li>
                            <li><a href="{{route('client.cart')}}"><i class="fa fa-shopping-bag"></i> <span>{{Cart::instance('cart')->count()}}</span></a></li>
                        </ul>
                        <div class="header__cart__price">.00item: <span>${{Cart::instance('cart')->total()}}</span></div>
                    </div>
                    @else
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{route('client.wishlist')}}"><i class="fa fa-heart"></i> <span>0</span></a></li>
                            <li><a href="{{route('client.cart')}}"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
                        </ul>
                        <div class="header__cart__price">.00item: <span>$0</span></div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
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
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('client.home') }}">Home</a>
                            @foreach($categories as $category1)
                            <span>Shop - Category - {{$category1->category}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">

                        <div class="sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                @foreach($categories_data as $category1)
                                    <li><a href="{{ route('client.category', ['slug' => $category1->slug]) }}">{{$category1->category}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Best Seller</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($aProducts as $product)
                                        <a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('storage/' . $product->image)}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ Str::limit($product->product_name, 25)}}</h6>
                                                <span>${{ $product->price}}.00</span>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($aProducts as $product)
                                        <a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('storage/' . $product->image)}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ Str::limit($product->product_name, 25)}}</h6>
                                                <span>${{ $product->price}}.00</span>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-9 col-md-7">
                    <div class="row">
                        @foreach($category->products as $product)
                            <a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $product->image)}}">
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}">{{ Str::limit($product->product_name, 50) }}</a></h6>
                                            <h5>${{ $product->price }}.00</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    @include('client.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('client.layouts.js')

</body>

{{-- {{ $cProducts->links() }} --}}
</html>
