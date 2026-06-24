@extends('layouts.guest')
@section('title', 'Register')
@section('content')
    <h4 class="text-center fw-bold mb-4" style="color: #1e1b4b;">Buat Akun Baru</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email Kampus</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="nim@mhs.unsoed.ac.id">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Gunakan email kampus (@mhs.unsoed.ac.id)</div>
        </div>
        <div class="mb-3">
            <label for="whatsapp" class="form-label fw-semibold">Nomor WhatsApp</label>
            <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="08xxxxxxxxxx">
            @error('whatsapp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Minimal 8 karakter">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password">
        </div>
        <button type="submit" class="btn btn-gradient w-100 py-2">Daftar</button>
        <p class="text-center mt-3 mb-0 small">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color: #667eea;">Masuk di sini</a></p>
    </form>
@endsection
