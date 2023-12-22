@extends('admin.app')

@section('content')


    <div class="container-xxl container-p-y flex-grow-1 text-nowrap">
        <div class="row">
            <div class="col-xl-12 mb-4">
                <div class="card">
                    @foreach($message as $item)
                    <h5 class="card-header">{{$item->name}} [{{$item->email}}]
                        @if($item->status == 0)
                        <span class="badge rounded-pill bg-primary">Stored</span>
                        @elseif($item->status == 1)
                        <span class="badge rounded-pill bg-warning">Handling</span>
                        @else
                        <span class="badge rounded-pill bg-success">Treated</span>
                        @endif
                    </h5>

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Message</label>
                            <div class="card">
                                <div class="card-body">
                                    <input type="text" readonly value="{!! $item->message !!}" id="input"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @if($item->status == 0)
                            <div class="col-xl-1">
                                <form action="{{route('admin.message.status', ['id' => $item->id])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Handling</button>
                                </form>
                            </div>
                            @elseif($item->status == 1)
                            <div class="col-xl-1">
                                <form action="{{route('admin.message.status', ['id' => $item->id])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Complete</button>
                                </form>
                            </div>
                            @endif
                            <div class="col-xl-1">
                                <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Back</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection

@section('admin-js')
@include('components.head.tinymce-config')
@endsection
