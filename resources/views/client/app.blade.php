<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Home Page</title>
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
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Categories</span>
                        </div>
                        <ul>
                            @foreach($categories_data as $category)
                                <li><a href="{{ route('client.category', ['slug' => $category->slug]) }}">{{$category->category}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{route('client.shop.search')}}">
                                <input type="text" placeholder="What do you need? Find products here!" name="search">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="{{ asset('client-theme/img/hero/banner.jpg') }}">
                        <div class="hero__text">
                            <span>All Fresh</span>
                            <h2 class="auto-type"></h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="{{ route('client.shop') }}" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
        <script>
            var typed = new Typed(".auto-type", {
                strings: ["Fresh Meat", "Vegetables", "Fresh Fruit", "Dried Fruit", "Drinks"],
                typeSpeed: 60,
                backSpeed: 60,
                loop: true
            })
        </script>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('client-theme/img/categories/cat-1.jpg') }}">
                            <h5><a href="#">Fresh Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('client-theme/img/categories/cat-2.jpg') }}">
                            <h5><a href="#">Dried Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('client-theme/img/categories/cat-3.jpg') }}">
                            <h5><a href="#">Vegetables</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('client-theme/img/categories/cat-4.jpg') }}">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('client-theme/img/categories/cat-5.jpg') }}">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('storage/' . $product->image)}}">
                            <ul class="featured__item__pic__hover">
                                <li>
                                    <form action="{{ route('client.wishlist.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="shopping_btn"><i class="fa fa-heart"></i></button>
                                    </form>
                                </li>
                                <li>
                                    @if($product->availability > 0)
                                    <form action="{{ route('client.cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="shopping_btn"><i class="fa fa-shopping-cart"></i></button>
                                    </form>
                                    @endif
                                </li>
                                <li><a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}"><i class="fa fa-eye"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}">{{ $product->product_name }}</a></h6>
                            <h5>{{ $product->price }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <a href="{{route('client.shop')}}">
                            <img src="{{ asset('client-theme/img/banner/banner-1.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <a href="{{route('client.shop')}}">
                            <img src="{{ asset('client-theme/img/banner/banner-2.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Items</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach($lProducts as $product)
                                <a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('storage/' . $product->image)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->product_name}}</h6>
                                        <span>{{ $product->price}}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach($lProducts as $product)
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('storage/' . $product->image)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->product_name}}</h6>
                                        <span>{{ $product->price}}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Items by Price</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach($pProducts as $product)
                                <a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('storage/' . $product->image)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->product_name}}</h6>
                                        <span>{{ $product->price}}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach($pProducts as $product)
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('storage/' . $product->image)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->product_name}}</h6>
                                        <span>{{ $product->price}}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Most Available</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach($aProducts as $product)
                                <a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('storage/' . $product->image)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->product_name}}</h6>
                                        <span>{{ $product->price}}</span>
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
                                        <h6>{{ $product->product_name}}</h6>
                                        <span>{{ $product->price}}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Checkout The Blogs</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('storage/' . $blog->image)}}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i>{{ $blog->created_at }}</li>
                                </ul>
                                <h5><a href="{{ route('client.blog-detail', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a></h5>
                                {{-- <p>{{ $blog->content }}</p> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
    @include('client.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->

</body>
@include('client.layouts.js')

</html>
