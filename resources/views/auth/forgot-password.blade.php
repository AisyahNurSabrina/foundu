@extends('layouts.guest')
@section('title', 'Lupa Password')
@section('content')
    <h4 class="text-center fw-bold mb-3" style="color: #1e1b4b;">Lupa Password?</h4>
    <p class="text-center text-muted small mb-4">Masukkan email kampus Anda dan kami akan mengirim link reset password.</p>
    @if(session('status'))
        <div class="alert alert-success small">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-gradient w-100 py-2">Kirim Link Reset</button>
        <p class="text-center mt-3 mb-0 small"><a href="{{ route('login') }}" class="text-decoration-none" style="color: #667eea;">Kembali ke login</a></p>
    </form>
@endsection
