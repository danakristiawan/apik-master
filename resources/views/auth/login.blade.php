@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
    <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip"
                value="{{ old('nip') }}">
            @error('nip')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                id="password" value="">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="{{ route('redirect') }}" class="btn btn-primary">Login Using SSO Kemenkeu</a>
    </form>
@endsection
