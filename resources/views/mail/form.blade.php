<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Test Mail</title>
</head>
<body>
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-message p-2">{{Session::get('success')}}</div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-message p-2">{{Session::get('error')}}</div>
        @endif

        <form action="{{route('send')}}" method="POST">
            @csrf
            <div class="form-group my-2">
                <label for="">Title</label>
                <input type="text" placeholder="Title" class="form-control" name="title">
                <span class="text-danger">@error('title'){{$message}}@enderror</span>
            </div>
            <div class="form-group my-2">
                <label for="">Receiver Mail</label>
                <input type="mail" placeholder="Receiver Mail" class="form-control" name="email">
                <span class="text-danger">@error('email'){{$message}}@enderror</span>
            </div>
            <div class="form-group my-2">
                <label for="">Email Body</label>
                <input type="text" placeholder="Body" class="form-control" name="body">
                <span class="text-danger">@error('body'){{$message}}@enderror</span>
            </div>
            <div class="form-group my-2">
                <label for="">Email Footer</label>
                <input type="text" placeholder="Footer" class="form-control" name="footer">
                <span class="text-danger">@error('footer'){{$message}}@enderror</span>
            </div>

            <button class="btn btn-primary btn-sm mt-3" type="submit">Send</button>
        </form>
    </div>
</body>
</html>
