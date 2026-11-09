@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')
    @php $isAdmin = Auth::user()->level === 'admin'; @endphp 
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Data Buku</h1>
        @if ($isAdmin)
            <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
        @endif
    </div>

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('buku.search') }}" method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="cari" class="form-control" placeholder="Cari ...">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Cover</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Genre</th>
                    <th class="text-end">Harga</th>
                    <th>Tanggal Terbit</th>
                    <th>PDF</th>
                    @if ($isAdmin)
                        <th>Aksi</th>   
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($data_buku as $index => $buku)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>
                            @if ($buku->cover)
                                <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover {{ $buku->judul }}" width="60" class="img-thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->genre }}</td>
                        <td class="text-end">{{ number_format($buku->harga, 0, ',', '.') }}</td>
                        <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                        <td>
                            @if ($buku->PDF)
                                <a href="{{ asset('storage/' . $buku->PDF) }}" target="_blank">Lihat PDF</a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        @if ($isAdmin)
                            <td>
                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{$isAdmin ? 10 : 9}}" class="text-center text-muted">Belum ada data buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $data_buku->links('pagination::bootstrap-5') }}
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <p class="mb-1">Jumlah data buku: <strong>{{ $jumlahBuku }}</strong></p>
            <p class="mb-0">Total harga semua buku: <strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        setTimeout(function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.remove();
            }
        }, 3000);
    </script>
@endpush