@extends('admin.app')

@section('content')

<div class="container-xxl container-p-y table-responsive text-nowrap">
    <div class="col-xl-12 mb-4">
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="{{route('user.search')}}" method="GET">
                <input type="text" class="form-control" placeholder="Search users" name="search">
                <button type="submit" class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </li>
            </ul>
        </div>
    </div>

    <table class="table container table-bordered">
        <thead class="text-center align-middle">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Avatar</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th>
                <a href="{{ route('admin.user.create')}}">
                    <button class="btn btn-sm btn-success" type="button">
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </th>
        </tr>
        </thead>

        @foreach($user as $key => $item)

        <tbody class="text-center">
        <tr>
            <td style="width: 3rem"> {{ ++$key }} </td>
            <td style="width: 3rem"> {{ $item->id }} </td>
            <td> {{ $item->name }} </td>
            @if (! $item->user_avatar)
                <td> <img src="{{ asset('admin-theme/assets/img/avatars/default-customer.png')}}" style="width: 100px"></td>
            @else
                <td> <img src="{{ asset('storage/' . $item->user_avatar)}}" style="width: 100px"> </td>
            @endif
            <td> {{ $item->phone_number }} </td>
            <td> {{ $item->email }} </td>
            <td>
                @if($item->deleted_at !== null)
                <span class="badge bg-label-danger">Deleted</span>
                @else
                <span class="badge bg-label-success">Active</span>
                @endif
            </td>
            <td style="width: 3rem"> {{ $item->created_at == null ? "N/A" : $item->created_at->format('H:i m/d/Y') }} </td>
            <td style="width: 3rem"> {{ $item->updated_at == null ? "N/A" : $item->updated_at->format('H:i m/d/Y') }} </td>
            <td style="width: 3rem">
                @if($item->deleted_at !== null)
                <form action="{{ route('admin.user.restore', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-info mb-2">
                        <i class="fa-solid fa-rotate-left"></i>
                    </button>
                </form>

                <form action="{{ route('admin.user.terminate', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa-solid fa-skull"></i>
                    </button>
                </form>
                @else
                <a href="{{ route('admin.user.edit', $item->id) }}" class="btn btn-sm btn-warning mb-2">
                    <i class="fa-solid fa-wrench"></i>
                </a>
                
                <form action="{{ route('admin.user.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
                @endif
            </td>
        </tr>
        </tbody>

        @endforeach
    </table>

    <div class="container-xxl container-p-y">
        {{ $user->onEachSide(1)->links() }}
    </div>
@endsection
