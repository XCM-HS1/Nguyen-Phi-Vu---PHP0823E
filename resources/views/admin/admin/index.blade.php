@extends('admin.app')

@section('content')

<div class="container-xxl container-p-y table-responsive text-nowrap">
    <div class="col-xl-12 mb-4">
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="{{route('admin.search')}}" method="GET">
                <input type="text" class="form-control" placeholder="Search admins" name="search">
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
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Avatar</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            @foreach($admin_data as $admin_info)
            @if($admin_info->name == 'admin')
                <th>
                    <a href="{{ route('admin.admin.create')}}">
                        <button class="btn btn-success btn-sm" type="button">
                            <i class="fa fa-plus"></i>
                        </button>
                    </a>
                </th>
            @endif
            @endforeach
        </tr>
        </thead>

        @foreach($admin as $key => $item)

        <tbody class="text-center">
        <tr>
            <td style="width: 3rem"> {{ ++$key }} </td>
            <td style="width: 3rem"> {{ $item->id }} </td>
            <td > {{ $item->name }} </td>
            @if (! $item->avatar)
                <td> <img src="{{ asset('admin-theme/assets/img/avatars/default-admin.png') }}" style="width: 100px"> </td>
            @else
                <td> <img src="{{ asset('storage/' . $item->avatar)}}" style="width: 100px"> </td>
            @endif
            <td> {{ $item->email }} </td>
            <td>
                @if($item->deleted_at !== null)
                <span class="badge bg-label-danger">Deleted</span>
                @else
                <span class="badge bg-label-success">Active</span>
                @endif
            </td>
            <td style="width: 3rem"> {{ $item->created_at === null ? "N/A" : $item->created_at->format('H:i m/d/Y')}} </td>
            <td style="width: 3rem"> {{ $item->updated_at === null ? "N/A" : $item->updated_at->format('H:i m/d/Y')}} </td>
            @foreach($admin_data as $admin_info)
            @if($admin_info->name == 'admin')
            <td style="width: 3rem">
                @if ($item->name !== 'admin' && $item->deleted_at == null)
                    <a href="{{ route('admin.admin.edit', $item->id) }}" class="btn btn-warning btn-sm mb-2">
                        <i class="fa-solid fa-wrench"></i>
                    </a>

                    <form action="{{ route('admin.admin.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                @elseif($item->deleted_at !== null)
                    <form action="{{ route('admin.admin.restore', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-info mb-2">
                            <i class="fa-solid fa-rotate-left"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.admin.terminate', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-skull"></i>
                        </button>
                    </form>
                @endif
            </td>
            @endif
            @endforeach
        </tr>
        </tbody>

        @endforeach
    </table>
</div>

<div class="container-xxl container-p-y">
    {{ $admin->onEachSide(1)->links() }}
</div>

@endsection

