<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @foreach($blogs as $blog1)
    <title>Ogani | Blog | {{$blog1->title}}</title>
    @endforeach
    <link rel="icon" type="image/x-icon" href="{{ asset('admin-theme/assets/img/favicon/favicon.ico') }}" />


    <!-- Google Font -->
    @include('client.layouts.font')

    <!-- Css Styles -->
    @include('client.layouts.css')
</head>

<body>
    <!-- Page Preloader -->
    @include('client.layouts.font')

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
                            <li ><a href="{{ route('client.home') }}">Home</a></li>
                            <li><a href="{{ route('client.shop') }}">Shop</a></li>
                            <li class="active"><a href="{{route('client.blog')}}">Blog</a></li>
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

    <!-- Blog Details Hero Begin -->
    @foreach($blogs as $blog1)

    <section class="blog-details-hero set-bg" data-setbg="{{ asset('client-theme/img/blog/details/details-hero.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>{{ $blog1->title }}</h2>
                        <ul>
                            <li>By {{ Auth::guard('admin')->name }}</li>
                            <li>{{ $blog1->created_at->format('m/d/Y') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->

    <section class="blog-details spad">
        <div class="container">
            <div class="row">

                <!-- Blog sidebar -->
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    <div class="blog__sidebar">

                        <div class="blog__sidebar__item">
                            <h4>Tags</h4>
                            <ul>
                                @foreach($tags as $tag1)
                                    <li><a href="{{ route('client.tag', ['slug' => $tag1->slug]) }}"> {{ $tag1->name }} </a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="blog__sidebar__item">
                            <h4>Recent News</h4>
                            @foreach($lBlogs as $blog2)
                            <div class="blog__sidebar__recent">
                                <a href="{{ route('client.blog-detail', ['slug' => $blog2->slug]) }}" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="{{ asset('storage/' . $blog2->image)}}" style="width: 100px">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>{{ Str::limit($blog2->title, 25) }}</h6>
                                        <span>{{ $blog2->created_at->format("m/d/Y") }}</span>
                                    </div>
                                </a>
                            </div>
                            <br>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Blog Section -->
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <!-- Blog Content -->
                    <div class="blog__details__text">
                        <h2 >{{ $blog1->title }}</h2> <br>
                        <p>{!! $blog1->content !!}</p>
                    </div>

                    <!-- Blog Poster -->
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{ asset('admin-theme/assets/img/avatars/7.png') }}" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>{{ Auth::guard('admin')->name }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Tags:</span> {{$blog1->tag->name}}</li>
                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </section>


    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Post You May Like</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($rBlogs as $blog3)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="{{ route('client.blog-detail', ['slug' => $blog3->slug]) }}">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{ asset('storage/' . $blog3->image)}}" >
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i>{{ $blog3->created_at->format('m/d/Y') }}</li>
                                    </ul>
                                    <h5>{{ Str::limit($blog3->title, 50) }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </section>
    <!-- Related Blog Section End -->

    <!-- Footer Section Begin -->
    @include('client.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('client.layouts.js')
</body>

</html>
