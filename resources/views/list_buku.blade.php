@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
    <h1 class="h3 mb-3">Katalog Buku</h1>

    <div class="row g-3">
        @forelse ($bukus as $buku)
            @php $gambar = $buku->foto ?? $buku->cover; @endphp
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('galeri.buku', $buku->buku_seo) }}" class="text-decoration-none text-reset">
                    <div class="card h-100 shadow-sm">
                        @if ($gambar)
                            <img src="{{ asset('storage/' . $gambar) }}" alt="{{ $buku->judul }}"
                                 class="card-img-top" style="height: 220px; object-fit: cover;">
                        @else
                            <div class="bg-secondary-subtle d-flex align-items-center justify-content-center"
                                 style="height: 220px;">
                                <span class="text-muted">Tanpa foto</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h6 class="card-title mb-0">{{ $buku->judul }}</h6>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted">Belum ada buku.</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $bukus->links('pagination::bootstrap-5') }}
    </div>
@endsection