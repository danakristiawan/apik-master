<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>APIK - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('img/apik-logo-clear.png') }}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar bg-light mb-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/apik-logo-clear.png') }}" alt="Bootstrap" width="30" height="24"
                    class="d-inline-block align-text-top"> Apik
            </a>
            @auth
                @if (Session::get('userInfo'))
                    <a href="{{ route('signout') }}" class="btn btn-sm btn-primary">Logout</a>
                @else
                    <div class="div">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-sm btn-primary" value="Logout">
                        </form>
                    </div>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
            @endauth
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 mb-3">
                <div class="list-group">
                    @include('layouts.sidebar')
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('js')
</body>

</html>
