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

    <title>Purchase History | {{$user->name}}</title>

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
                <span class="text-muted fw-light">Purchase History /</span> {{$user->name}}
              </h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.account', $user->id)}}"
                        ><i class="bx bx-user me-1"></i> Account</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('user.security', $user->id)}}"
                        ><i class="bx bx-lock-alt me-1"></i> Security</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href=""
                        ><i class="bx bx-history me-1"></i> Purchase History </a
                      >
                    </li>
                  </ul>

                  <div class="card">
                    <h5 class="card-header">Purchased Products</h5>
                    <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered border-bottom">
                        <thead class="text-center text-nowrap">
                          <tr>
                            <th>Order ID</th>
                            <th>Placed At</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Detail</th>
                          </tr>
                        </thead>
                        <tbody class="text-nowrap text-center">
                            @foreach($order_data as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->created_at->format('H:i m/d/Y')}}</td>
                                <td>{{$data->total}}</td>
                                <td>{{$data->payment_method}}</td>
                                <td>{{$data->note}}</td>
                                <td>
                                    @if($data->status == 0)
                                    <span class="badge rounded-pill bg-primary">Processing</span>
                                    @elseif ($data->status == 1)
                                    <span class="badge rounded-pill bg-warning">On Delivery</span>
                                    @else
                                    <span class="badge rounded-pill bg-success">Completed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('user.order_detail', ['id' => $data->id])}}">
                                        <button type="button" class="btn btn-secondary btn-sm">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <div class="mb-3 mt-4 col-md-12">
                        <a href="{{route('client.home')}}">
                            <button type="button" class="btn btn-outline-secondary">Back</button>
                        </a>
                    </div>
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
