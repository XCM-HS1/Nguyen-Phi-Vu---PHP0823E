<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @foreach($user_data as $data)
    <title>Ogani | Wishlist | {{$data->name}}</title>
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
                        <h2>Wishist</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('client.home')}}">Home</a>
                            <span>Wishlist</span>
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
            @if ($WishlistItems->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlistAuth as $item)

                                <tr>
                                    <td class="shoping__cart__item">
                                        @foreach($products as $product)
                                        <a href="{{ route('client.product-detail', ['slug' => $product->slug]) }}" target="blank">
                                                <img src="{{ asset('storage/' . $item->image)}}" style="width: 120px">
                                            <h5>{{ Str::limit($item->product_name, 40) }}</h5>
                                        </a>
                                        @endforeach
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{ $item->price }}.00
                                    </td>
                                    <td class="shoping__cart__price">
                                        @if ($item->availability > 0)
                                            <h5>In Stock</h5>
                                        @else
                                            <h5>Out Of Stock</h5>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->availability > 0)
                                        <a href="#" onclick="moveToCart('{{ $item->rowId }}')" class="primary-btn">
                                            <i class="fa-solid fa-cart-plus"></i>
                                            <input type="hidden" name="quantity" value="1">
                                        </a>
                                        @endif
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
                    <h2>Your wishlist is empty!</h2>
                    <h5 class="mt-5">Continue Shoppping!</h5>
                    <a href="{{route('client.shop')}}" class="btn btn-warning mt-5">Shop Now</a>
                </div>
            </div>
            @endif

            @if($WishlistItems->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('client.shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right" onclick="clearAll()">Clear All Items</a>
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
    <form id="deleteItem" action="{{route('client.wishlist.remove')}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" id="rowIdDelete" name="rowId" />
    </form>

    <form id="clearAll" action="{{route('client.wishlist.clear')}}" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <form action="{{ Route('client.wishlist.add.cart') }}" id="moveToCart" method="POST">
        @csrf
        <input type="hidden" name="rowId" id="mrowId" />
    </form>

    <script>
        function removeItem(rowId)
        {
            $('#rowIdDelete').val(rowId);
            $('#deleteItem').submit();
        }

        function clearAll()
        {
            $('#clearAll').submit();
        }

        function moveToCart(rowId)
        {
            $("#mrowId").val(rowId);
            $("#moveToCart").submit();
        }
    </script>
</body>

</html>
