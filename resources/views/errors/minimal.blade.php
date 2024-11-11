<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customcss.css') }}">
    <style>
        body {
            height: 100vh;
            background-color: #fff; /* Changed background property to background-color */
        }
        .card {
            width: 525px;
            background: none; /* Changed background property to background-color */
            box-shadow: none; /* Changed box-shadow property to none */
            margin: 0; /* Removed margin-bottom */
        }
        .btn {
            font-size: 21px;
            font-weight: 600;
        }
        h3 {
            color: #263238;
            font-weight: 300;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="card">
        @yield('message')
    </div>
</body>
</html>
