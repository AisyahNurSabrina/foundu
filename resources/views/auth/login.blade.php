@extends('layouts.guest')
@section('title', 'Login')
@section('content')
    <h4 class="text-center fw-bold mb-4" style="color: #1e1b4b;">Masuk ke Akun</h4>

    @if(session('status'))
        <div class="alert alert-success small">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="email@mhs.unsoed.ac.id">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukkan password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label small" for="remember">Ingat saya</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-decoration-none" style="color: #667eea;">Lupa password?</a>
            @endif
        </div>
        <button type="submit" class="btn btn-gradient w-100 py-2">Masuk</button>
        <p class="text-center mt-3 mb-0 small">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" style="color: #667eea;">Daftar sekarang</a></p>
    </form>
@endsection
