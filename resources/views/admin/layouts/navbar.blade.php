<!-- Navbar -->

<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar"
>
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <ul class="navbar-nav flex-row align-items-center ms-auto">
    @foreach($admin_data as $item)

    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            @if($item->avatar !== null)
            <img src="{{ asset('storage/' . $item->avatar)}}" alt class="w-px-40 h-auto rounded-circle" />
            @else
            <img src="{{ asset('admin-theme/assets/img/avatars/default-admin.png') }}" alt class="w-px-40 h-auto rounded-circle" />
            @endif
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          @if($item->name !== 'admin')
          <a class="dropdown-item" href="{{route('admin.detail', $item->id)}}">
          @else
          <a class="dropdown-item" href="#">
          @endif
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                  @if($item->avatar !== null)
                  <img src="{{ asset('storage/' . $item->avatar)}}" alt class="w-px-40 h-auto rounded-circle" />
                  @else
                  <img src="{{ asset('admin-theme/assets/img/avatars/default-admin.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                  @endif
                </div>
              </div>
              <div class="flex-grow-1">
                <span class="fw-semibold d-block">{{ $item->name }}</span>
                <small class="text-muted">{{$item->email}}</small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('admin.logout') }}">
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle">Log Out</span>
          </a>
        </li>
      </ul>
    </li>

    @endforeach

  </ul>
</div>
</nav>

<!-- / Navbar -->
