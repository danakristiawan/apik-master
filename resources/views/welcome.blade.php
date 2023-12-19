<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>APIK - Selamat Datang</title>
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
            <div class="col m-5">
                <figure class="text-center">
                    <blockquote class="blockquote">
                        <p class="display-5">Aplikasi Penatausahaan Internal Kas</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Sebuah alat bantu Bendahara Penerimaan dalam membukukan transaksi
                        pada <cite title="Source Title">rekening penampungan.</cite>
                    </figcaption>
                    <img src="{{ asset('img/welcome.svg') }}" alt="office image">
                </figure>
            </div>
        </div>
    </div>
</body>

</html>
