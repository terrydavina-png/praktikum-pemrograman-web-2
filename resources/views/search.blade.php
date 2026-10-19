<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pencarian Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">
        Tambah Buku
    </a>

    <h1>Hasil Pencarian Buku</h1>

    <br>

    @if(count($data_buku))

        <div class="alert alert-success">
            Ditemukan <strong>{{ count($data_buku) }}</strong> data dengan
            kata: <strong>{{ $cari }}</strong>
        </div>

        <table border="1" cellpadding="8" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Genre</th>
                    <th>Harga</th>
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

                        <td>
                            Rp {{ number_format($buku->harga, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $buku->tgl_terbit->format('d/m/Y') }}
                        </td>

                        <td>
                            <a href="{{ route('buku.edit', $buku->id) }}"
                               class="btn btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('buku.destroy', $buku->id) }}"
                                  method="POST"
                                  style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $data_buku->appends(['cari' => $cari])->links('pagination::bootstrap-5') }}
        </div>

    @else

        <div class="alert alert-warning">
            <h4>Data {{ $cari }} tidak ditemukan</h4>

            <a href="/buku" class="btn btn-warning">
                Kembali
            </a>
        </div>

    @endif

    <br>

    <a href="/buku" class="btn btn-secondary">
        Kembali ke Data Buku
    </a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>