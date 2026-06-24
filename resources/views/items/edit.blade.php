@extends('layouts.app')
@section('title', 'Edit Barang')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 fade-in-up">
        <div class="card card-glass border-0" style="border-radius: var(--radius-lg);">
            <div class="card-body p-4 p-md-5">
                <h3 class="page-title mb-1">Edit Barang Temuan</h3>
                <p class="text-muted mb-4 mt-2">Perbarui informasi barang temuan</p>

                <form method="POST" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $item->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $item->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pickup_point_id" class="form-label">Titik Pengambilan <span class="text-danger">*</span></label>
                            <select class="form-select @error('pickup_point_id') is-invalid @enderror" id="pickup_point_id" name="pickup_point_id" required>
                                <option value="">Pilih Titik Pengambilan</option>
                                @foreach($pickupPoints as $pp)
                                    <option value="{{ $pp->id }}" {{ old('pickup_point_id', $item->pickup_point_id) == $pp->id ? 'selected' : '' }}>{{ $pp->name }} — {{ $pp->location }}</option>
                                @endforeach
                            </select>
                            @error('pickup_point_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="location_found" class="form-label">Lokasi Penemuan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('location_found') is-invalid @enderror" id="location_found" name="location_found" value="{{ old('location_found', $item->location_found) }}" required>
                        @error('location_found') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="form-label">Foto Barang</label>
                        @if($item->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $item->photo) }}" alt="Current Photo" class="rounded" style="max-height: 150px; border-radius: var(--radius-md) !important;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/jpeg,image/png,image/jpg">
                        <div class="form-text">Kosongkan jika tidak ingin mengubah foto.</div>
                        @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gradient"><i class="bi bi-check-lg me-1"></i> Perbarui</button>
                        <a href="{{ route('items.show', $item) }}" class="btn btn-outline-glass">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
