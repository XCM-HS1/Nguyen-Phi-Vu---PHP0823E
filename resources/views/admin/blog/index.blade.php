@extends('admin.app')

@section('content')

<div class="container-xxl container-p-y table-responsive text-nowrap">
    <div class="col-xl-12 mb-4">
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="{{route('blog.search')}}" method="GET">
                <input type="text" class="form-control" placeholder="Search blogs" name="search">
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
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Content</th>
            <th scope="col">Image</th>
            <th scope="col">Tags</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th>
                <a href="{{ route('admin.blog.create')}}">
                    <button class="btn btn-sm btn-success" type="button">
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </th>
        </tr>
        </thead>

        @foreach($blog as $key => $item)

        <tbody class="text-center">
        <tr>
            <td style="width: 3rem"> {{ ++$key }} </td>
            <td style="width: 3rem"> {{ $item->id }} </td>
            <td> {{ Str::limit($item->title, 20) }} </td>
            <td> {{ Str::limit($item->slug, 20) }} </td>
            <td> {!! Str::limit($item->content, 50) !!} </td>
            <td > <img src="{{ asset('storage/' . $item->image)}}" style="width: 150px"> </td>
            <td style="width: 3rem"> {{ $item->tag?->name }} </td>
            <td style="width: 3rem"> {{ $item->updated_at->format('H:i m/d/Y') }} </td>
            <td style="width: 3rem"> {{ $item->created_at->format('H:i m/d/Y') }} </td>
            <td style="width: 3rem">
                <a href="{{ route('admin.blog.edit', $item->id) }}" class="btn btn-sm btn-warning mb-2">
                    <i class="fa-solid fa-wrench"></i>
                </a>

                <form action="{{ route('admin.blog.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        </tbody>

        @endforeach
    </table>
</div>

<div class="container-xxl container-p-y">
    {{ $blog->onEachSide(1)->links() }}
</div>
@endsection
