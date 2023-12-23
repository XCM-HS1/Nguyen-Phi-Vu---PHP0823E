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
    <title>View Rated Item | {{$user1->name}}</title>
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
                <span class="text-muted fw-light">View Rated Item /</span> {{$user1->name}}
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

                  @foreach($view_data as $item)
                  <div class="card">
                    <h5 class="card-header">Rated Information ({{$item->created_at}})</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                            @foreach($fixed_data as $data)
                            <img
                            src="{{ asset('storage/' . $data->image)}}"
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            id="uploadedAvatar"
                            />
                            <div>
                                <h4>{{$item->product_name}}</h4>
                                <h5>${{$data->price}}</h5>
                                <div>
                                    @switch($item->rating)
                                        @case(0.5)
                                            <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            @break
                                        @case(1)
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            @break
                                        @case(1.5)
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            @break
                                        @case(2)
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            @break
                                        @case(2.5)
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            @break
                                        @case(3)
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            @break
                                        @case(3.5)
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            @break
                                        @case(4)
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-regular fa-star" style="color: #e9d60c;"></i>
                                            @break
                                        @case(4.5)
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star-half-stroke" style="color: #e9d60c;"></i>
                                            @break
                                        @default
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            <i class="fa-solid fa-star" style="color: #e9d60c;"></i>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Review Line</h5>
                            </div>
                            <div class="card-body">
                                <pre>{{$item->review}}</pre>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5>Review Picture</h5>
                            </div>
                            <div class="card-body">
                                <img
                                src="{{ asset('storage/' . $item->image)}}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar"
                                />
                            </div>
                        </div>

                    <div class="mb-3 mt-4 col-md-12">
                    @foreach($order_data as $data)
                        <a href="{{route('user.order_detail', ['id' => $data->id])}}">
                            <button type="button" class="btn btn-outline-secondary">Back</button>
                        </a>
                    @endforeach
                    </div>
                  </div>
                  @endforeach

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
