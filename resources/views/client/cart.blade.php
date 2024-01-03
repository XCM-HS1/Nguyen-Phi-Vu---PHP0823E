<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @foreach($user_data as $data)
    <title>Ogani | Cart | {{$data->name}}</title>
    @endforeach
    <link rel="icon" type="image/x-icon" href="{{ asset('admin-theme/assets/img/favicon/favicon.ico') }}" />

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
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('client.home')}}">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            @if ($cartItems->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset('storage/' . $item->options['image'])}}" style="width: 120px">
                                        <h5>{{ $item->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{ $item->price }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty" >
                                                <input type="number" data-rowid="{{ $item->rowId }}" value="{{ $item->qty }}" onchange="updateQuantity(this)"     oninput="this.value = Math.abs(this.value)">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{ $item->subtotal() }}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close" onclick="removeItem('{{ $item->rowId }}')"></span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Your cart is empty!</h2>
                    <h5 class="mt-5">Continue Shoppping!</h5>
                    <a href="{{route('client.shop')}}" class="btn btn-warning mt-5">Shop Now</a>
                </div>
            </div>
            @endif

            @if($cartItems->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('client.shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right" onclick="clearCart()">Clear All Items</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>${{Cart::instance('cart')->subtotal()}}</span></li>
                            <li>Total <span>${{Cart::instance('cart')->total()}} (+10% VAT)</span></li>
                        </ul>
                        <a href="{{ route('client.checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
    @include('client.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('client.layouts.js')

    <form id="updateCartQuantity" action="{{route('client.cart.update')}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="rowId" name="rowId" />
        <input type="hidden" id="quantity" name="quantity" />
    </form>

    <form id="deleteItem" action="{{route('client.cart.remove')}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" id="rowIdDelete" name="rowId" />
    </form>

    <form id="clearCart" action="{{route('client.cart.clear')}}" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function updateQuantity(qty)
        {
            $('#rowId').val($(qty).data('rowid'));
            $('#quantity').val($(qty).val());
            $('#updateCartQuantity').submit();
        }

        function removeItem(rowId)
        {
            $('#rowIdDelete').val(rowId);
            $('#deleteItem').submit();
        }

        function clearCart()
        {
            $('#clearCart').submit();
        }
    </script>
</body>

</html>
