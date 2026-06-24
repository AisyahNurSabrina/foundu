@extends('layouts.app')
@section('title', $item->name)
@section('content')
<div class="mb-3">
    <a href="{{ route('items.index') }}" class="text-decoration-none fw-medium" style="color: #667eea;"><i class="bi bi-arrow-left me-1"></i> Kembali ke daftar</a>
</div>

<div class="row g-4">
    <div class="col-lg-5 fade-in-up">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius-lg); overflow: hidden;">
            @if($item->photo)
                <img src="{{ asset('storage/' . $item->photo) }}" class="card-img-top" alt="{{ $item->name }}" style="max-height: 420px; object-fit: cover;">
            @else
                <div class="photo-placeholder" style="height: 320px;">
                    <i class="bi bi-image" style="font-size: 4rem; color: rgba(139,92,246,0.35);"></i>
                </div>
            @endif
        </div>
    </div>
    <div class="col-lg-7 fade-in-up">
        <div class="card card-glass border-0" style="border-radius: var(--radius-lg);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="badge rounded-pill fs-6 {{ $item->status === 'tersedia' ? 'badge-tersedia' : ($item->status === 'diverifikasi' ? 'badge-diverifikasi' : 'badge-terklaim') }}">
                        {{ ucfirst($item->status) }}
                    </span>
                    <small class="text-muted">{{ $item->created_at->format('d M Y, H:i') }}</small>
                </div>

                <h2 class="fw-bold" style="color: var(--color-text);">{{ $item->name }}</h2>
                <p class="text-muted mt-3" style="line-height: 1.7;">{{ $item->description }}</p>

                <hr style="border-color: rgba(102,126,234,0.1);">

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-tag"></i></div>
                            <div>
                                <small class="text-muted d-block">Kategori</small>
                                <strong>{{ $item->category->name }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-item">
                            <div class="info-icon" style="background: rgba(139,92,246,0.08); color: #7c3aed;"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <small class="text-muted d-block">Lokasi Penemuan</small>
                                <strong>{{ $item->location_found }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-item">
                            <div class="info-icon" style="background: rgba(59,130,246,0.08); color: #2563eb;"><i class="bi bi-building"></i></div>
                            <div>
                                <small class="text-muted d-block">Titik Pengambilan</small>
                                <strong>{{ $item->pickupPoint->name }}</strong>
                                <small class="text-muted d-block">{{ $item->pickupPoint->location }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-item">
                            <div class="info-icon" style="background: rgba(16,185,129,0.08); color: #059669;"><i class="bi bi-person"></i></div>
                            <div>
                                <small class="text-muted d-block">Dilaporkan oleh</small>
                                <strong>{{ $item->user->name }}</strong>
                                @if($item->user->whatsapp)
                                    <small class="d-block mt-1"><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->user->whatsapp) }}" target="_blank" class="text-decoration-none" style="color: #25d366;"><i class="bi bi-whatsapp"></i> {{ $item->user->whatsapp }}</a></small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="border-color: rgba(102,126,234,0.1);">

                <div class="d-flex flex-wrap gap-2">
                    @auth
                        @if($item->user_id === auth()->id() || auth()->user()->isAdmin())
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-outline-glass btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
                            <form method="POST" action="{{ route('items.destroy', $item) }}" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-gradient-danger btn-sm"><i class="bi bi-trash me-1"></i> Hapus</button>
                            </form>
                        @endif
                        @if($item->user_id === auth()->id() && $item->status !== 'terklaim')
                            <button type="button" class="btn btn-gradient-success btn-sm" data-bs-toggle="modal" data-bs-target="#claimModal">
                                <i class="bi bi-check-circle me-1"></i> Tandai Terklaim
                            </button>
                        @endif
                        @if(auth()->user()->isAdmin())
                            <button type="button" class="btn btn-sm" style="background: linear-gradient(135deg, #f59e0b, #f97316); color: white; border: none; border-radius: var(--radius-sm);" data-bs-toggle="modal" data-bs-target="#reportModal">
                                <i class="bi bi-flag me-1"></i> Laporkan Spam
                            </button>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        @if($item->claims->count() > 0)
            <div class="card card-glass border-0 mt-4" style="border-radius: var(--radius-lg);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-check2-all me-2" style="color: #667eea;"></i>Riwayat Klaim</h5>
                    @foreach($item->claims as $claim)
                        <div class="p-3 mb-2" style="background: rgba(102,126,234,0.04); border: 1px solid rgba(102,126,234,0.08); border-radius: var(--radius-md);">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $claim->claimant->name }}</strong>
                                <small class="text-muted">{{ $claim->claimed_at->format('d M Y, H:i') }}</small>
                            </div>
                            <p class="mb-0 mt-1 text-muted small">{{ $claim->proof_text }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

@auth
@if($item->user_id === auth()->id() && $item->status !== 'terklaim')
<div class="modal fade" id="claimModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('items.claim', $item) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tandai Barang Terklaim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Berikan keterangan bahwa barang ini sudah diambil oleh pemiliknya.</p>
                    <div class="mb-3">
                        <label for="proof_text" class="form-label fw-semibold">Keterangan Klaim <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="proof_text" name="proof_text" rows="3" placeholder="Contoh: Sudah diambil oleh pemilik, diverifikasi dengan KTM" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-glass" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-success"><i class="bi bi-check-lg me-1"></i> Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if(auth()->user()->isAdmin())
<div class="modal fade" id="reportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.items.report', $item) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-danger"><i class="bi bi-flag me-2"></i>Laporkan & Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Barang ini akan di-soft delete dan alasan akan dicatat.</p>
                    <div class="mb-3">
                        <label for="reason" class="form-label fw-semibold">Alasan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Contoh: Konten spam, bukan barang temuan" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-glass" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-danger"><i class="bi bi-trash me-1"></i> Hapus & Laporkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endauth
@endsection
