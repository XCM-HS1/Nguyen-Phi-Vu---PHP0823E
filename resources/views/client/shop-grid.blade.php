<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Shop</title>

    <!-- Google Font -->
    @include('client.layouts.font')

    <!-- Css Styles -->
    @include('client.layouts.css')
</head>

<body>
    <!-- Page Preloader -->
    @include('client.layouts.preload')


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
                        <div class="header__cart__price">item: <span>${{Cart::instance('cart')->total()}}</span></div>
                    </div>
                    @else
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{route('client.wishlist')}}"><i class="fa fa-heart"></i> <span>0</span></a></li>
                            <li><a href="{{route('client.cart')}}"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>$0</span></div>
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
                            <span>Shop</span>
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
                                @foreach($categories_data as $category)
                                    <li><a href="{{ route('client.category', ['slug' => $category->slug]) }}">{{$category->category}}</a></li>
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
                                                @if($product->availability == 0)
                                                <h6>{{ $product->product_name}}</h6>
                                                <p>(Out Of Stock)</p>
                                                @else
                                                <h6>{{ $product->product_name }}</h6>
                                                <span>{{ $product->price}}</span>
                                                @endif
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($aProducts as $product)
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('storage/' . $product->image)}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                @if($product->availability == 0)
                                                <h6>{{ $product->product_name}}</h6>
                                                <p>(Out Of Stock)</p>
                                                @else
                                                <h6>{{ $product->product_name }}</h6>
                                                <span>{{ $product->price}}</span>
                                                @endif
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
                    {{-- <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('client-theme/img/product/discount/pd-1.jpg') }}">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('client-theme/img/product/discount/pd-2.jpg') }}">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Vegetables</span>
                                            <h5><a href="#">Vegetables’package</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('client-theme/img/product/discount/pd-3.jpg') }}">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Mixed Fruitss</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('client-theme/img/product/discount/pd-4.jpg') }}">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('client-theme/img/product/discount/pd-5.jpg') }}">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('client-theme/img/product/discount/pd-6.jpg') }}">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <h2>Preview Product</h2>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Order By</span>
                                    <select name="" id="">
                                        <option value="">12</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($products as $product)
                            <a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $product->image)}}">
                                        </div>
                                        <div class="product__item__text">
                                            @if($product->availability !== 0)
                                            <h6><a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}">{{ $product->product_name }}</a></h6>
                                            <h5>{{ $product->price }}</h5>
                                            @else
                                            <h6><a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}">{{ $product->product_name }}</a></h6>
                                            <p>(Out Of Stock)</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <h2>Out Of Stock</h2>
                        <div class="filter__item">
                            <div class="row">
                                <div class="col-lg-4 col-md-5">
                                    <div class="filter__sort">
                                        <span>Order By</span>
                                        <select name="" id="">
                                            <option value="">12</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        @foreach($out_of_stock as $product)
                            <a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $product->image)}}">
                                        </div>
                                        <div class="product__item__text">
                                            @if($product->availability !== 0)
                                            <h6><a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}">{{ $product->product_name }}</a></h6>
                                            <h5>{{ $product->price }}</h5>
                                            @else
                                            <h6><a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}">{{ $product->product_name }}</a></h6>
                                            <p>(Out Of Stock)</p>
                                            @endif
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

    {{ $products->links() }}
</html>
