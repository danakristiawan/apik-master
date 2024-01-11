<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('img/apik-logo-clear.png') }}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>

    </style>
</head>

<body style="background-color: white;">
    <nav class="navbar bg-light mb-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/apik-logo-clear.png') }}" alt="Bootstrap" width="30" height="24"
                    class="d-inline-block align-text-top"> Apik
            </a>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col m-5">
                <figure class="text-center">
                    <blockquote class="blockquote">
                        <p class="display-6">@yield('message')</p>
                    </blockquote>
                    <blockquote class="blockquote">
                        <a href="{{ route('home') }}" class="btn btn-xl btn-primary">Redirect to Home Page</a>
                    </blockquote>
                    <img src="{{ asset('img/welcome.svg') }}" alt="office image">
                </figure>
            </div>
        </div>
    </div>
</body>

</html>
