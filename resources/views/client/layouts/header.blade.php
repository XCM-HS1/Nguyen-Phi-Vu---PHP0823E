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
                        <li class="active"><a href="{{ route('client.home') }}">Home</a></li>
                        <li><a href="{{ route('client.shop') }}">Shop</a></li>
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
