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
    <title>Product Rating | {{$user1->name}}</title>
    @endforeach
    <meta name="description" content="" />

    @include('admin.layouts.css')
  </head>

  <body>
    <style>
        /* Star Rating */
        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

        fieldset, label { margin: 0; padding: 0; }
        body{ margin: 20px; }
        h1 { font-size: 1.5em; margin: 10px; }

        /****** Style Star Rating Widget *****/

        .rating {
        border: none;
        float: left;
        }

        .rating > input { display: none; }
        .rating > label:before {
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
        }

        .rating > .half:before {
        content: "\f089";
        position: absolute;
        }

        .rating > label {
        color: #ddd;
        float: right;
        }

        /***** CSS Magic to Highlight Stars on Hover *****/

        .rating > input:checked ~ label, /* show gold star when clicked */
        .rating:not(:checked) > label:hover, /* hover current star */
        .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

        .rating > input:checked + label:hover, /* hover current star when changing rating */
        .rating > input:checked ~ label:hover,
        .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
        .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }
    </style>

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
                <span class="text-muted fw-light">Product Rating /</span> {{$user1->name}}
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

                  <form action="{{ route('user.pRating') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$id}}" name="product_id"/>
                    <div class="card">
                        <h5 class="card-header">Leave a review to better our performance in the future!</h5>
                        <div class="card-body">

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Comment Section</label>
                                <textarea type="text" class="form-control" id="content" name="review" ></textarea>
                            </div>
                            <div class="mb-3 col-md-4">
                                <div class="rating form-control">
                                    <input type="radio" required id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" required id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                    <input type="radio" required id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" required id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                    <input type="radio" required id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" required id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                    <input type="radio" required id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" required id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                    <input type="radio" required id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                    <input type="radio" required id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                </div>
                            </div>
                      </div>
                      <div class="card">
                        <div class="card-body">
                            <div class="col-md-6 mb-4">
                                <label for="formFile" class="form-label">Images</label>
                                <input class="form-control" type="file" id="formFile" name="image" />
                            </div>

                            <div class="mb-3 col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('user.order_detail', ['id' => $data->id])}}">
                                    <button type="button" class="btn btn-outline-secondary">Back</button>
                                </a>
                            </div>
                        </div>
                      </div>
                  </form>
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
