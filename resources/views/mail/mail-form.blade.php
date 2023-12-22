<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body class="bg-light">
    <div class="container">
        {{-- <img src="{{$message->embed(asset('client-theme/img/logo.png'))}}" alt=""> --}}
      <div class="card p-6 p-lg-10 space-y-4">
        <h1 class="h3 fw-700">
          Greetings, {{$mailData['title']}}
        </h1>
        <h2>We would like to send our best regard and many thanks to you for submitting your message.</h2>
        <h3>Don't worry, your message is stored and we will contact you as soon as possible!</h3>
        <h4>In the meantime, below is a copy of your message which you can only send one time per phone number.
            We're very sorry for the inconveniences you may have while using our website.
            Feel free to checkout our latest products while waiting for our email.
        </h4>
        <h4>Once again, thank you for your times!</h4>
        <p>
          {{$mailData['body']}}
        </p>
        <a class="btn btn-primary p-3 fw-700" href="https://127.0.0.1:8000/home">Visit Organi</a>
      </div>

      <div class="text-muted text-center my-6">
        Sent from Organi Project. <br>
        Hip Corp. 1 Hip Street<br>
        Gnarly State, 01234 USA <br>
      </div>

      <h6>{{$mailData['footer']}}</h6>
    </div>
  </body>
</html>
