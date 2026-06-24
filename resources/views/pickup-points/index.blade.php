@extends('layouts.app')
@section('title', 'Titik Pengambilan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title mb-1">Titik Pengambilan</h2>
        <p class="text-muted mb-0 mt-2">Kelola titik pengambilan barang temuan</p>
    </div>
    <a href="{{ route('pickup-points.create') }}" class="btn btn-gradient"><i class="bi bi-plus-lg me-1"></i> Tambah Titik</a>
</div>

<div class="card table-premium border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Jumlah Barang</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pickupPoints as $index => $pp)
                        <tr>
                            <td class="ps-4">{{ $pickupPoints->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $pp->name }}</td>
                            <td class="text-muted">{{ $pp->location }}</td>
                            <td><span class="badge badge-location rounded-pill">{{ $pp->items_count }} barang</span></td>
                            <td class="text-end pe-4">
                                <a href="{{ route('pickup-points.edit', $pp) }}" class="btn btn-sm btn-outline-glass"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('pickup-points.destroy', $pp) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-gradient-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada titik pengambilan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-4">{{ $pickupPoints->links() }}</div>
@endsection
