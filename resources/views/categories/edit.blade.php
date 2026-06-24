@extends('layouts.app')
@section('title', 'Edit Kategori')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 fade-in-up">
        <div class="card card-glass border-0" style="border-radius: var(--radius-lg);">
            <div class="card-body p-4 p-md-5">
                <h3 class="page-title mb-4">Edit Kategori</h3>
                <form method="POST" action="{{ route('categories.update', $category) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gradient"><i class="bi bi-check-lg me-1"></i> Perbarui</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-glass">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
