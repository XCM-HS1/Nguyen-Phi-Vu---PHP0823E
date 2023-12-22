<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Product</title>

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
                        <h2>Vegetable’s Package</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('client.home')}}">Home</a>
                            {{-- <a href="./index.html">Vegetables</a> --}}
                            <span>Vegetable’s Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">

        @foreach($products as $product)
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('storage/' . $product->image)}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ asset('client-theme/img/product/details/product-details-2.jpg') }}"
                                src="{{ asset('client-theme/img/product/details/thumb-1.jpg') }}" alt="">
                            <img data-imgbigurl="{{ asset('client-theme/img/product/details/product-details-3.jpg') }}"
                                src="{{ asset('client-theme/img/product/details/thumb-2.jpg') }}" alt="">
                            <img data-imgbigurl="{{ asset('client-theme/img/product/details/product-details-5.jpg') }}"
                                src="{{ asset('client-theme/img/product/details/thumb-3.jpg') }}" alt="">
                            <img data-imgbigurl="{{ asset('client-theme/img/product/details/product-details-4.jpg') }}"
                                src="{{ asset('client-theme/img/product/details/thumb-4.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->product_name }}</h3>
                        <div class="product__details__rating') }}">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">${{ $product->price }}</div>

                        @if($product->availability >= 1)

                            <form action="{{ route('client.cart.add') }}" method="POST">
                            @csrf
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="number" name="quantity" value="1" required min="1" oninput="this.value = Math.abs(this.value)">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn">ADD TO CARD</button>
                            </form>
                            <form action="{{ route('client.wishlist.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="heart-icon"><span class="icon_heart_alt"></span></button>
                            </form>

                        @else
                        <p>The product you looking for is currently out of stock! Stay tuned for more updates!</p>
                        <a href="{{ route('client.shop')}}" class="primary-btn">BACK TO SHOP</a>
                        <form action="{{ route('client.wishlist.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="heart-icon"><span class="icon_heart_alt"></span></button>
                        </form>
                        @endif
                        <ul>
                            @if($product->availability >= 1)
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            @else
                            <li><b>Availability</b> <span><samp>Out Of Stock</samp></span></li>
                            @endif
                            <li><b>Weight</b> <span>{{ $product->weight}} kg</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Reviews</h6>
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                        <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Something You May Like</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($rProducts as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $item->image)}}">
                            <ul class="product__item__pic__hover">
                                <li>
                                    <form action="{{ route('client.wishlist.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="shopping_btn"><i class="fa fa-heart"></i></button>
                                    </form>
                                </li>
                                <li>
                                    @if($item->availability > 0)
                                    <form action="{{ route('client.cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="shopping_btn"><i class="fa fa-shopping-cart"></i></button>
                                    </form>
                                    @endif
                                </li>
                                <li><a href="{{ route('client.product-detail', ['slug' => $item->slug]) }}"><i class="fa fa-eye"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">{{ $item->product_name }}</a></h6>
                            <h5>${{ $item->price }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    @include('client.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('client.layouts.js')


</body>
</html>
