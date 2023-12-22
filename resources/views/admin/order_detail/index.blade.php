@extends('admin.app')

@section('content')

<div class="container-xxl container-p-y">
    <div class="row ">
        <div class="col-xl-12">
            <div class="card mb-4">
            <h3 class="card-header divider">Order Manager</h3>
            </div>
        </div>
    </div>

    <div class="mb-3">
        @foreach($orders as $item)
        @if($item->status == 0)
            <span class="badge rounded-pill bg-primary">Processing</span>
            @elseif ($item->status == 1)
            <span class="badge rounded-pill bg-warning">On Delivery</span>
            @else
            <span class="badge rounded-pill bg-success">Completed</span>
        @endif
        @endforeach
    </div>

    <table class="table table-bordered table-hover container text-center">
        <thead class="align-middle">
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">User Name</th>
            <th scope="col">User Email</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Total</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Address</th>
            <th scope="col">Note</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
          </tr>
        </thead>

        @foreach($orders as $key => $item)

        <tbody>
          <tr>
            <td style="width: 3rem"> {{ $item->id }} </td>
            <td> {{ $item->user_name }} </td>
            <td> {{ $item->email }} </td>
            <td style="width: 3rem"> {{ $item->subtotal }} </td>
            <td style="width: 3rem"> {{ $item->total }} </td>
            <td style="width: 3rem"> {{ $item->phone }} </td>
            <td> {{ $item->address }} </td>
            <td> {{ $item->note }} </td>
            <td style="width: 3rem"> {{ $item->payment_method }} </td>
            <td style="width: 3rem"> {{ $item->created_at }} </td>
            <td style="width: 3rem"> {{ $item->updated_at }}</td>
          </tr>
        </tbody>

        @endforeach
    </table>

    <table class="table table-bordered table-hover container text-center mb-4">
        <thead class="align-middle">
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Order ID</th>
            <th scope="col">Product ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
          </tr>
        </thead>

        @foreach($order_detail as $key => $item)
            <tbody>
            <tr>
                <td style="width: 3rem"> {{ ++$key }} </td>
                <td style="width: 3rem"> {{ $item->order_id }} </td>
                <td style="width: 3rem"> {{ $item->product_id }} </td>
                <td> {{ $item->products }} </td>
                <td style="width: 10rem"> {{ $item->quantity }} </td>
                <td style="width: 10rem"> {{ $item->price }} </td>
            </tr>
            </tbody>
        @endforeach
    </table>

    @foreach($orders as $item)
        <div class="row">
            @if($item->status == 0)
            <div class="col-xl-1">
                <form action="{{route('admin.order.status', ['id' => $item->id])}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Delivery</button>
                </form>
            </div>
            @elseif($item->status == 1)
            <div class="col-xl-1">
                <form action="{{route('admin.order.status', ['id' => $item->id])}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Complete</button>
                </form>
            </div>
            @elseif($item->status == 2)
            <div class="col-xl-1">
                <form action="{{ route('admin.order.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            @endif
            <div class="col-xl-1">
                <a href="{{ route('admin.order.index') }}">
                    <button type="button" class="btn btn-dark">Back</button>
                </a>
            </div>
        </div>
    @endforeach
</div>

@endsection
