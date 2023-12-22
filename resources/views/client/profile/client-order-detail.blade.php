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
                    <h5 class="card-header">Order Detail</h5>
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
                          </tr>
                        </thead>

                        <tbody class="text-nowrap text-center">
                            <tr>
                                @foreach($order_detail as $key => $item)
                                <td> {{++$key}} </td>
                                <td> {{$item->order_id}} </td>
                                <td class="inline-block">
                                    <img src="{{ asset('storage/' . $item->image)}}" style="width: 80px">
                                    <p> {{$item->products}} </p>
                                </td>
                                <td> {{$item->quantity}} </td>
                                <td> {{$item->price}} </td>
                                @endforeach
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="mb-3 mt-4 col-md-12">
                        <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Back</button>
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
