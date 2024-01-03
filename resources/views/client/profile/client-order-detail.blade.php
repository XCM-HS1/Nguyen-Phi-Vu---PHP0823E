<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    @foreach($user_data as $user1)
    <title>Order Manager | {{$user1->name}}</title>
    @endforeach
    <meta name="description" content="" />

    @include('admin.layouts.css')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Order Manager /</span> {{$user1->name}}
              </h4>

              <div class="row">
                <div class="col-md-12">
                    @foreach($user_data as $user1)
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.account', $user1->id)}}"
                        ><i class="bx bx-user me-1"></i> Account</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.security', $user1->id)}}"
                        ><i class="bx bx-lock-alt me-1"></i> Security</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{route('user.purchase.history', $user1->id)}}"
                        ><i class="bx bx-history me-1"></i> Purchase History </a
                      >
                    </li>
                  </ul>
                  @endforeach

                  <div class="card">
                    <h5 class="card-header">Order Detail
                        @if($data2->status == 0)
                        <span class="badge bg-primary">Processing</span>
                        @elseif($data2->status == 1)
                        <span class="badge bg-warning">On Delivery</span>
                        @else
                        <span class="badge bg-success">Completed</span>
                        @endif
                    </h5>

                    <div class="card-body">
                        <div class="table-responsive">
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

                                @foreach($orders as $item)

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
                        </div>
                    </div>

                    <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered border-bottom">
                        <thead class="text-center text-nowrap">
                          <tr>
                            <th>STT</th>
                            <th>Order ID</th>
                            <th>Products</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            @if($data2->status==2)
                            <th>Status</th>
                            <th>Rating</th>
                            @elseif ($data1->review_status==1)
                            <th>Status</th>
                            <th>View Rated</th>
                            @endif
                          </tr>
                        </thead>

                        <tbody class="text-nowrap text-center">
                            @foreach($order_detail as $key => $item)
                            <tr>
                                <td> {{++$key}} </td>
                                <td> {{$item->order_id}} </td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->image)}}" style="width: 80px">
                                    <p> {{$item->products}} </p>
                                </td>
                                <td> {{$item->quantity}} </td>
                                <td> {{$item->price}} </td>

                                @if($data2->status == 2)
                                    @if($item->review_status == 0)
                                    <td>
                                        <span class="badge bg-danger">Not Rated</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.rating', ['id' => $item->product_id]) }}">
                                            <button type="button" class="btn btn-warning btn-sm">Rate Now!</button>
                                        </a>
                                    </td>
                                    @else
                                    <td>
                                        <span class="badge bg-success">Rated</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.view.rating', ['id' => $item->order_id, 'product_id' => $item->product_id]) }}">
                                            <button type="button" class="btn btn-sm btn-info">View</button>
                                        </a>
                                    </td>
                                    @endif
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>

                    <div class="mb-3 mt-4 col-md-12">
                    @foreach($user_data as $user1)
                        <a href="{{route('user.purchase.history', $user1->id)}}">
                            <button type="button" class="btn btn-outline-secondary">Back</button>
                        </a>
                    @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div class="buy-now">
        <a
          href="{{route('client.shop')}}"
          target="_blank"
          class="btn btn-danger btn-buy-now"
          >Shop Now</a
        >
      </div>


   @include('admin.layouts.js')
  </body>
</html>
