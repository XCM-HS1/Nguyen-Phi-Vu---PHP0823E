<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Organi - Admin | Dashboard</title>
    <meta name="description" content="" />

    <!-- CSS Core -->
    @include('admin.layouts.css')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Layout container -->
        <div class="layout-page">

          <!-- Navbar -->
          @include('admin.layouts.navbar')
          @yield('content')

          <!-- Content -->
          {{-- @include('admin.layouts.content') --}}

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
        href="{{ route('client.home') }}"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Visit Home Site</a
      >
    </div>

    <!-- JS Core -->
    @include('admin.layouts.js')
  </body>
</html>
