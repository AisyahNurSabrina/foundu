@extends('layouts.app')
@section('title', 'Laporan Moderasi')
@section('content')
<div class="mb-4">
    <h2 class="page-title">Laporan Moderasi</h2>
    <p class="text-muted mt-2">Daftar barang yang telah dilaporkan dan dihapus</p>
</div>

<div class="card table-premium border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Barang</th>
                        <th>Alasan</th>
                        <th>Admin</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $index => $report)
                        <tr>
                            <td class="ps-4">{{ $reports->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $report->item ? $report->item->name : 'Item dihapus permanen' }}</td>
                            <td class="text-muted">{{ Str::limit($report->reason, 80) }}</td>
                            <td><span class="badge badge-category rounded-pill">{{ $report->admin->name }}</span></td>
                            <td class="text-muted">{{ $report->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada laporan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-4">{{ $reports->links() }}</div>
@endsection
