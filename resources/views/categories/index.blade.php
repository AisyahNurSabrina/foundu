@extends('layouts.app')
@section('title', 'Kategori')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title mb-1">Kategori</h2>
        <p class="text-muted mb-0 mt-2">Kelola kategori barang temuan</p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn btn-gradient"><i class="bi bi-plus-lg me-1"></i> Tambah Kategori</a>
</div>

<div class="card table-premium border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Barang</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <td class="ps-4">{{ $categories->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td><span class="badge badge-category rounded-pill">{{ $category->items_count }} barang</span></td>
                            <td class="text-end pe-4">
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-glass"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-gradient-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada kategori</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-4">{{ $categories->links() }}</div>
@endsection
