@extends('admin.app')

@section('content')

<div class="container-xxl container-p-y table-responsive text-nowrap">
    <div class="col-xl-12 mb-4">
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="{{route('product.search')}}" method="GET">
                <input type="text" class="form-control" placeholder="Search products" name="search">
                <button type="submit" class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </li>
            </ul>
        </div>
    </div>

    <table class="table container table-bordered">
        <thead class="text-center align-middle">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Avail</th>
            <th scope="col">Weight</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th>
                <a href="{{ route('admin.product.create')}}">
                    <button class="btn btn-sm btn-success" type="button">
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </th>
        </tr>
        </thead>

        @foreach($product as $key => $item)
        <tbody class="text-center">
        <tr>
            <td style="width: 3rem"> {{ ++$key }} </td>
            <td style="width: 3rem"> {{ $item->id }} </td>
            <td> {{ $item->product_name }} </td>
            <td> <img src="{{ asset('storage/' . $item->image)}}" style="width: 100px"> </td>
            <td style="width: 3rem"> {{ $item->price }} </td>
            @if($item->availability == 0)
            <td> Out Of Stock </td>
            @else
            <td> In Stock </td>
            @endif
            <td style="width: 3rem"> {{ $item->weight }} </td>
            <td> {!! Str::limit($item->description, 50) !!} </td>
            <td> {{ $item->category?->category }} </td>
            <td style="width: 3rem">
                <a href="{{ route('admin.product.edit', $item->id) }}" class="btn btn-sm btn-warning mb-2">
                    <i class="fa-solid fa-wrench"></i>
                </a>

                <form action="{{ route('admin.product.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        </tbody>

        @endforeach
    </table>
</div>

<div class="container-xxl container-p-y">
    {{ $product->onEachSide(1)->links() }}
</div>
@endsection
