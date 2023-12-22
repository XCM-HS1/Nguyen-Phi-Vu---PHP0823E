@extends('admin.app')

@section('content')

<div class="container-xxl container-p-y table-responsive text-nowrap">
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <ul class="navbar-nav w-100">
                <li class="nav-item w-100">
                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="{{route('order.search')}}" method="GET">
                    <input type="text" class="form-control" placeholder="Search orders" name="search">
                    <button type="submit" class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </li>
                </ul>
            </div>
        </div>
    </div>


    <table class="table table-bordered table-hover container">
        <thead class="text-center">
        <tr class="text-nowrap">
            <th scope="col" >Order ID</th>
            <th scope="col">User Name</th>
            <th scope="col" >User Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col" >Address</th>
            <th scope="col" >Payment Method</th>
            <th scope="col">Status</th>
            <th scope="col">Detail</th>
        </tr>
        </thead>

        @foreach($order as $key => $item)

        <tbody class="text-center">
        <tr>
            <td style="width: 3rem"> {{ $item->id }} </td>
            <td style="width: 3rem"> {{ $item->user_name }} </td>
            <td> {{ $item->email }} </td>
            <td style="width: 3rem"> {{ $item->phone }} </td>
            <td> {{ Str::limit($item->address, 20) }} </td>
            <td style="width: 3rem"> {{ $item->payment_method }} </td>
            <td style="width: 3rem">
                @if($item->status == 0)
                <span class="badge rounded-pill bg-primary">Processing</span>
                @elseif ($item->status == 1)
                <span class="badge rounded-pill bg-warning">On Delivery</span>
                @else
                <span class="badge rounded-pill bg-success">Completed</span>
                @endif
            </td>
            <td style="width: 3rem">
                <a href="{{route('admin.order_detail', ['id' => $item->id])}}">
                    <button type="button" class="btn btn-secondary btn-sm">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </a>
            </td>
        </tr>
        </tbody>

        @endforeach
    </table>
</div>
<div class="container-xxl container-p-y">
    {{ $order->onEachSide(1)->links() }}
</div>
@endsection
