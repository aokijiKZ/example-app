<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>About</title>
</head>

<body>
    <div class="container">
        <h1>Welcome to website</h1>
        <p>บร่าๆๆๆๆๆๆๆๆๆๆๆๆๆๆ</p>
        <a href="{{ url('/')}}">Home</a>
        <a href="{{ route('admin') }}">Admin</a>
        <a href="{{ route('member') }}">Member</a>
        <a href="{{ route('about') }}">About</a>

    </div>
</body>

</html>
