@extends('layouts.app')

@section('title', $buku->judul)

@push('styles')
    <link rel="stylesheet" href="{{ asset('lightbox2/dist/css/lightbox.min.css') }}">
@endpush

@section('content')
    <a href="{{ route('buku.list') }}" class="btn btn-outline-secondary btn-sm mb-3">&larr; Kembali ke katalog</a>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h1 class="h3">{{ $buku->judul }}</h1>
            <dl class="row mb-0">
                <dt class="col-sm-3">Penulis</dt>
                <dd class="col-sm-9">{{ $buku->penulis }}</dd>

                <dt class="col-sm-3">Penerbit</dt>
                <dd class="col-sm-9">{{ $buku->penerbit ?? '-' }}</dd>

                <dt class="col-sm-3">Genre</dt>
                <dd class="col-sm-9">{{ $buku->genre ?? '-' }}</dd>

                <dt class="col-sm-3">Tanggal terbit</dt>
                <dd class="col-sm-9">{{ $buku->tgl_terbit->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Harga</dt>
                <dd class="col-sm-9">Rp {{ number_format($buku->harga, 0, ',', '.') }}</dd>

                @if ($buku->PDF)
                    <dt class="col-sm-3">Preview</dt>
                    <dd class="col-sm-9">
                        <a href="{{ asset('storage/' . $buku->PDF) }}" target="_blank">Lihat PDF</a>
                    </dd>
                @endif
            </dl>
        </div>
    </div>

    <h2 class="h5 mb-3">Galeri Foto</h2>

    <div class="row g-3">
        @forelse ($galeris as $data)
            <div class="col-6 col-md-4">
                <a href="{{ asset('storage/posts_images/' . $data->picture) }}"
                   data-lightbox="buku-{{ $buku->id }}"
                   data-title="{{ $data->description }}">
                    <img src="{{ asset('storage/posts_images/' . $data->picture) }}"
                         alt="{{ $data->title }}" class="img-fluid rounded"
                         style="width: 100%; height: 180px; object-fit: cover;">
                </a>
                <p class="small fw-semibold mt-1 mb-0">{{ $data->title }}</p>
            </div>
        @empty
            <p class="text-muted">Buku ini belum punya foto galeri.</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $galeris->links('pagination::bootstrap-5') }}
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('lightbox2/dist/js/lightbox-plus-jquery.min.js') }}"></script>
@endpush