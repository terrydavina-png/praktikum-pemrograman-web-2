@extends('layouts.app')

@section('title', 'Pencarian Buku')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Hasil Pencarian Buku</h1>
        <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
    </div>

    @if (count($data_buku))

        <div class="alert alert-success">
            Ditemukan <strong>{{$data_buku->total()}}</strong> data dengan
            kata: <strong>{{ $cari }}</strong>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Genre</th>
                        <th class="text-end">Harga</th>
                        <th>Tanggal Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_buku as $index => $buku)
                        <tr>
                            <td>{{ $no + $index + 1 }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->penerbit }}</td>
                            <td>{{ $buku->genre }}</td>
                            <td class="text-end">Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                            <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $data_buku->appends(['cari' => $cari])->links('pagination::bootstrap-5') }}
        </div>

    @else

        <div class="alert alert-warning">
            <h4 class="alert-heading">Data "{{ $cari }}" tidak ditemukan</h4>
            <p class="mb-0">Coba kata kunci lain, atau kembali ke daftar buku.</p>
        </div>

    @endif

    <a href="/buku" class="btn btn-secondary mt-3">Kembali ke Data Buku</a>
@endsection