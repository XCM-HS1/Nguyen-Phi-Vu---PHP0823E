<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Checkout</title>
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

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <h5>Select one payment method to process</h5>

                <div class="col-lg-12">
                    <div class="product__details__tab product__details__tab__2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">
                                    <button type="button" class="site-btn">COD</button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">
                                    <button type="button" class="site-btn">VNPay</button>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>COD</h6>

                                    <form action="{{ route('client.pcheckout') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-8 col-md-6">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Name<span>*</span></p>
                                                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                                            <input type="text" name="name" readonly value="{{ Auth::user()->name }}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Email<span>*</span></p>
                                                            <input type="email" name="email" readonly value="{{ Auth::user()->email }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Phone<span>*</span></p>
                                                            <input type="text" name="phone" value="{{ Auth::user()->phone_number }}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="checkout__input">
                                                    <p>Address<span>*</span></p>
                                                    <input type="text" placeholder="Full Address" class="checkout__input__add" name="address" value="{{ Auth::user()->address }}" />
                                                </div>
                                                <div class="checkout__input">
                                                    <p>Notes</p>
                                                    <input type="text"
                                                        placeholder="Notes about your order, e.g. special notes for delivery."
                                                        name="note"
                                                        maxlength="100"
                                                        />
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div class="checkout__order">

                                                    <h4>Your Order</h4>
                                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                                    <ul>
                                                        @foreach($cartItems as $item)
                                                        <li>{{ $item->name }} (x{{ $item->qty }})<span>{{ $item->subtotal() }}</span></li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="checkout__order__subtotal">Subtotal <span>{{ Cart::instance('cart')->subtotal() }}</span></div>
                                                    <div class="checkout__order__total">Total <span>{{ Cart::instance('cart')->total() }} (+10% VAT)</span></div>

                                                    <div class="checkout__input__checkbox">
                                                        <label for="agree">
                                                            I agree to all Terms and Conditions along with Privacy Policy
                                                            <input type="checkbox" id="agree" required>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <button type="submit" class="site-btn">PLACE ORDER</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>VNPAY</h6>

                                    <form action="{{ route('vnpay') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-8 col-md-6">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Name<span>*</span></p>
                                                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                                            <input type="text" name="name" readonly value="{{ Auth::user()->name }}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Email<span>*</span></p>
                                                            <input type="email" name="email" readonly value="{{ Auth::user()->email }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Phone<span>*</span></p>
                                                            <input type="text" name="phone" value="{{ Auth::user()->phone_number }}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="checkout__input">
                                                    <p>Address<span>*</span></p>
                                                    <input type="text" placeholder="Full Address" class="checkout__input__add" name="address" value="{{ Auth::user()->address }}" />
                                                </div>
                                                <div class="checkout__input">
                                                    <p>Notes</p>
                                                    <input type="text"
                                                        placeholder="Notes about your order, e.g. special notes for delivery."
                                                        name="note"
                                                        maxlength="100"
                                                        />
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div class="checkout__order">

                                                    <h4>Your Order</h4>
                                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                                    <ul>
                                                        @foreach($cartItems as $item)
                                                        <li>{{ $item->name }} (x{{ $item->qty }})<span>{{ $item->subtotal() }}</span></li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="checkout__order__subtotal">Subtotal <span>{{ Cart::instance('cart')->subtotal() }}</span></div>
                                                    <div class="checkout__order__total">Total <span>{{ Cart::instance('cart')->total() }} (+10% VAT)</span></div>

                                                    <div class="checkout__input__checkbox">
                                                        <label for="agree1">
                                                            I agree to all Terms and Conditions along with Privacy Policy
                                                            <input type="checkbox" id="agree1" required>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <input name="total" type="hidden" value="{{ Cart::instance('cart')->total() }}">
                                                    <button type="submit" name="redirect" class="site-btn">VNPAY</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section Begin -->
    @include('client.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('client.layouts.js')
</body>

</html>
