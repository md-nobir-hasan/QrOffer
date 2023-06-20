<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collect INFO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="container p-4">
        <form class="row g-3 shadow-lg p-4 mt-4 rounded" method="POST" action="{{route('otp.match')}}">
            @csrf
            <div>
                <h1 class="text-center">OTP: {{$user->otp}}</h1>
            </div>
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <div class="col-md-12">
                <label for="validationDefault01" class="form-label fw-bolder">Enter OTP</label>
                <input type="text" name="otp" class="form-control" id="validationDefault01" placeholder="Enter OTP" required>
            </div>

            <div class="col-12 text-center">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
       </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
