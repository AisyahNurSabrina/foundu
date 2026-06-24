@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="mb-4">
    <h2 class="page-title">Admin Dashboard</h2>
    <p class="text-muted mt-2">Ringkasan data platform FoundU</p>
</div>

{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-md-3 col-6 fade-in-up">
        <div class="card stat-card text-center">
            <div class="card-body py-4">
                <div class="stat-icon stat-icon-purple mx-auto mb-2"><i class="bi bi-box-seam"></i></div>
                <h3 class="fw-bold mb-0">{{ $stats['total_items'] }}</h3>
                <small class="text-muted fw-medium">Total Barang</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 fade-in-up">
        <div class="card stat-card text-center">
            <div class="card-body py-4">
                <div class="stat-icon stat-icon-green mx-auto mb-2"><i class="bi bi-check-circle"></i></div>
                <h3 class="fw-bold mb-0">{{ $stats['items_tersedia'] }}</h3>
                <small class="text-muted fw-medium">Tersedia</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 fade-in-up">
        <div class="card stat-card text-center">
            <div class="card-body py-4">
                <div class="stat-icon stat-icon-rose mx-auto mb-2"><i class="bi bi-hand-thumbs-up"></i></div>
                <h3 class="fw-bold mb-0">{{ $stats['items_terklaim'] }}</h3>
                <small class="text-muted fw-medium">Terklaim</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 fade-in-up">
        <div class="card stat-card text-center">
            <div class="card-body py-4">
                <div class="stat-icon stat-icon-amber mx-auto mb-2"><i class="bi bi-people"></i></div>
                <h3 class="fw-bold mb-0">{{ $stats['total_users'] }}</h3>
                <small class="text-muted fw-medium">Mahasiswa</small>
            </div>
        </div>
    </div>
</div>

{{-- Latest Items --}}
<div class="card table-premium border-0">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0"><i class="bi bi-clock-history me-2" style="color: #667eea;"></i>Barang Terbaru</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Nama</th>
                        <th>Kategori</th>
                        <th>Pelapor</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestItems as $item)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $item->name }}</td>
                            <td><span class="badge badge-category rounded-pill">{{ $item->category->name }}</span></td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $item->status === 'tersedia' ? 'badge-tersedia' : ($item->status === 'diverifikasi' ? 'badge-diverifikasi' : 'badge-terklaim') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="text-muted">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-glass">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
