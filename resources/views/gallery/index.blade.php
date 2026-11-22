@extends('layouts.app')

@section('title', 'Galeri Buku')

@push('styles')
    <link rel="stylesheet" href="{{ asset('lightbox2/dist/css/lightbox.min.css') }}">
@endpush

@section('content')
    @php $isAdmin = Auth::user()->level === 'admin'; @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Galeri Buku</h1>
        @if ($isAdmin)
            <a href="{{ route('gallery.create') }}" class="btn btn-primary">Tambah Foto</a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3">
        @forelse ($galleries as $gallery)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <a href="{{ asset('storage/posts_images/' . $gallery->picture) }}"
                       data-lightbox="galeri"
                       data-title="{{ $gallery->description }}">
                        <img src="{{ asset('storage/posts_images/' . $gallery->picture) }}"
                             alt="{{ $gallery->title }}"
                             class="card-img-top"
                             style="height: 160px; object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <h6 class="card-title mb-1">{{ $gallery->title }}</h6>
                        <p class="card-text small text-muted mb-0">
                            {{ $gallery->buku?->judul ?? 'Tanpa buku' }}
                        </p>
                    </div>
                    @if ($isAdmin)
                        <div class="card-footer bg-transparent d-flex gap-1">
                            <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus foto ini?')">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada foto.</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $galleries->links('pagination::bootstrap-5') }}
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('lightbox2/dist/js/lightbox-plus-jquery.min.js') }}"></script>
@endpush