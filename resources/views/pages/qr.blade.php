<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR CODE</title>
    <style>
        .flex{
            display: flex;
        }
        .justify-center{
            justify-content: center;
        }
        .align-item{
            align-items: center;
        }
        .h-full{
            height: 100vh;
        }
    </style>
</head>
<body class="flex justify-center align-item h-full">
    <div >
        {!! QrCode::size(300)->generate($url); !!}
        <p>Scan me to get to the offer.</p>
    </div>
</body>
</html>
