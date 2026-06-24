@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
{{-- Hero Banner --}}
<div class="card hero-banner border-0 shadow mb-4" style="border-radius: 20px;">
    <div class="card-body p-4 p-md-5 position-relative" style="z-index: 1;">
        <h2 class="fw-bold text-white mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
        <p class="mb-0" style="color: rgba(255,255,255,0.7); font-size: 1.05rem;">Temukan atau laporkan barang yang hilang di kampus melalui <strong style="color: #a78bfa;">FoundU</strong>.</p>
    </div>
</div>

{{-- Action Cards --}}
<div class="row g-4">
    <div class="col-md-4 fade-in-up">
        <div class="card action-card h-100">
            <div class="card-body text-center p-4">
                <div class="action-icon stat-icon-purple mx-auto">
                    <i class="bi bi-plus-circle"></i>
                </div>
                <h5 class="fw-bold mt-3">Laporkan Temuan</h5>
                <p class="text-muted small">Menemukan barang? Laporkan agar pemiliknya bisa mengambil.</p>
                <a href="{{ route('items.create') }}" class="btn btn-gradient btn-sm"><i class="bi bi-plus-lg me-1"></i> Buat Laporan</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 fade-in-up">
        <div class="card action-card h-100">
            <div class="card-body text-center p-4">
                <div class="action-icon stat-icon-amber mx-auto">
                    <i class="bi bi-search"></i>
                </div>
                <h5 class="fw-bold mt-3">Cari Barang</h5>
                <p class="text-muted small">Kehilangan sesuatu? Cari di daftar barang temuan.</p>
                <a href="{{ route('items.index') }}" class="btn btn-gradient btn-sm"><i class="bi bi-search me-1"></i> Lihat Barang</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 fade-in-up">
        <div class="card action-card h-100">
            <div class="card-body text-center p-4">
                <div class="action-icon stat-icon-green mx-auto">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h5 class="fw-bold mt-3">Laporan Saya</h5>
                <p class="text-muted small">Anda telah melaporkan <strong class="text-primary">{{ Auth::user()->items()->count() }}</strong> barang temuan.</p>
                <a href="{{ route('items.index') }}" class="btn btn-gradient btn-sm"><i class="bi bi-eye me-1"></i> Lihat Semua</a>
            </div>
        </div>
    </div>
</div>
@endsection
