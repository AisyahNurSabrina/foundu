@extends('layouts.app')
@section('title', 'Barang Temuan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title mb-1">Barang Temuan</h2>
        <p class="text-muted mb-0 mt-2">Daftar barang yang ditemukan di area kampus</p>
    </div>
    @auth
        <a href="{{ route('items.create') }}" class="btn btn-gradient">
            <i class="bi bi-plus-lg me-1"></i> Laporkan Barang
        </a>
    @endauth
</div>

{{-- Search & Filter --}}
<div class="card filter-bar border-0 mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('items.index') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold small text-muted">🔍 Cari Barang</label>
                <input type="text" name="search" class="form-control" placeholder="Ketik nama barang..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small text-muted">📂 Kategori</label>
                <select name="category_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small text-muted">📌 Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                    <option value="terklaim" {{ request('status') == 'terklaim' ? 'selected' : '' }}>Terklaim</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-gradient w-100"><i class="bi bi-funnel me-1"></i> Filter</button>
            </div>
        </form>
    </div>
</div>

{{-- Items Grid --}}
@if($items->count() > 0)
    <div class="row g-4">
        @foreach($items as $item)
            <div class="col-md-6 col-lg-4 fade-in-up">
                <div class="card card-premium h-100">
                    <div style="overflow: hidden;">
                        @if($item->photo)
                            <img src="{{ asset('storage/' . $item->photo) }}" class="card-img-top" alt="{{ $item->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="photo-placeholder">
                                <i class="bi bi-image fs-1" style="color: rgba(139,92,246,0.4);"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge rounded-pill {{ $item->status === 'tersedia' ? 'badge-tersedia' : ($item->status === 'diverifikasi' ? 'badge-diverifikasi' : 'badge-terklaim') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                            <small class="text-muted" style="font-size: 0.78rem;"><i class="bi bi-clock me-1"></i>{{ $item->created_at->diffForHumans() }}</small>
                        </div>
                        <h5 class="fw-bold mb-1" style="color: var(--color-text);">{{ $item->name }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit($item->description, 75) }}</p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge badge-category rounded-pill"><i class="bi bi-tag me-1"></i>{{ $item->category->name }}</span>
                            <span class="badge badge-location rounded-pill"><i class="bi bi-geo-alt me-1"></i>{{ $item->pickupPoint->name }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="bi bi-person me-1"></i>{{ $item->user->name }}</small>
                            <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-glass">Detail <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $items->links() }}
    </div>
@else
    <div class="empty-state" style="display:flex; flex-direction:column; align-items:center;">
        <i class="bi bi-inbox"></i>
        <h5 class="mt-3 fw-bold" style="color: var(--color-text);">Belum ada barang temuan</h5>
        <p class="text-muted">Jadi yang pertama melaporkan barang temuan!</p>
        @auth
            <a href="{{ route('items.create') }}" class="btn btn-gradient btn-sm mt-2"><i class="bi bi-plus-lg me-1"></i> Laporkan Sekarang</a>
        @endauth
    </div>
@endif
@endsection