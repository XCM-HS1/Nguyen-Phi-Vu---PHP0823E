@extends('admin.app')

@section('content')

<div class="container-xxl container-p-y table-responsive text-nowrap">
    <div class="col-xl-12 mb-4">
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="{{route('review.search')}}" method="GET">
                <input type="text" class="form-control" placeholder="Search reviews" name="search">
                <button type="submit" class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </li>
            </ul>
        </div>
    </div>

    <table class="table table-bordered container">


        <thead class="text-center align-middle">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Order ID</th>
            <th scope="col">Username</th>
            <th scope="col">Product Name</th>
            <th scope="col">Review</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>

        @foreach($review as $key => $item)

        <tbody class="text-center">
        <tr>
            <td style="width: 3rem"> {{ ++$key }} </td>
            <td style="width: 3rem"> {{$item->order_id}} </td>
            <td > {{ $item->user_name }} </td>
            <td> {{Str::limit($item->product_name, 50)}} </td>
            <td> {{Str::limit($item->review, 50)}} </td>
            @if ($item->status == 0)
                <td><span class="badge bg-primary"> Not Rated </span></td>
            @elseif ($item->status == 1)
                <td><span class="badge bg-warning"> Rated/Not Verified </span></td>
            @else
                <td><span class="badge bg-success"> Verified </span></td>
            @endif
            <td style="width: 3rem"> {{ $item->created_at === null ? "N/A" : $item->created_at->format('H:i m/d/Y')}} </td>
            @if( $item->status == 0)
            <td></td>
            @else
            <td style="width: 3rem">
                <a href="{{ route('admin.review.edit', $item->id) }}" class="btn btn-warning btn-sm mb-2">
                    <i class="fa-solid fa-wrench"></i>
                </a>
                <form action="{{ route('admin.review.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
            @endif
        </tr>
        </tbody>

        @endforeach
    </table>
</div>

<div class="container-xxl container-p-y">
    {{ $review->onEachSide(1)->links() }}
</div>

@endsection

