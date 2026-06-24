@extends('layouts.app')
@section('title', 'Profil')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        {{-- Update Profile --}}
        <div class="card card-glass border-0 mb-4 fade-in-up" style="border-radius: var(--radius-lg);">
            <div class="card-body p-4 p-md-5">
                <h3 class="page-title mb-1">Informasi Profil</h3>
                <p class="text-muted mb-4 mt-2">Perbarui nama dan email akun Anda</p>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-gradient"><i class="bi bi-check-lg me-1"></i> Simpan</button>
                    @if (session('status') === 'profile-updated')
                        <span class="text-success ms-3 small"><i class="bi bi-check-circle-fill"></i> Tersimpan!</span>
                    @endif
                </form>
            </div>
        </div>

        {{-- Update Password --}}
        <div class="card card-glass border-0 mb-4 fade-in-up" style="border-radius: var(--radius-lg);">
            <div class="card-body p-4 p-md-5">
                <h3 class="page-title mb-1">Ubah Password</h3>
                <p class="text-muted mb-4 mt-2">Gunakan password yang kuat dan unik</p>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password">
                        @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password">
                        @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-gradient"><i class="bi bi-check-lg me-1"></i> Ubah Password</button>
                    @if (session('status') === 'password-updated')
                        <span class="text-success ms-3 small"><i class="bi bi-check-circle-fill"></i> Tersimpan!</span>
                    @endif
                </form>
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="card border-0 mb-4 fade-in-up" style="border-radius: var(--radius-lg); border-left: 4px solid #ef4444 !important; background: rgba(255,255,255,0.6); backdrop-filter: blur(16px);">
            <div class="card-body p-4 p-md-5">
                <h3 class="fw-bold mb-1 text-danger">Hapus Akun</h3>
                <p class="text-muted mb-4">Setelah akun dihapus, semua data akan hilang secara permanen.</p>
                <button type="button" class="btn btn-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    <i class="bi bi-trash me-1"></i> Hapus Akun
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-danger">Konfirmasi Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Masukkan password Anda untuk mengkonfirmasi penghapusan akun.</p>
                    <div class="mb-3">
                        <label for="delete_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="delete_password" name="password" required placeholder="Masukkan password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-glass" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-danger"><i class="bi bi-trash me-1"></i> Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
