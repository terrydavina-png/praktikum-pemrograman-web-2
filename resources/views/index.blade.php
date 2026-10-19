<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker.min.css">
</head>
<body>
    <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>
    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function () {
                const alert = document.getElementById('success-alert');

                if (alert) {
                    alert.remove();
                }
            }, 3000);
        </script>
    @endif
    <h1>Data Buku</h1>
    <br> 

    <form action="{{ route('buku.search') }}" method="get">
        <input type="text"
            name="cari"
            class="form-control"
            placeholder="Cari ..."
            style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Genre</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data_buku as $index => $buku)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->genre }}</td>
                    <td>{{ number_format($buku->harga, 0, ',', '.') }}</td>
                    <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">
                            Edit
                        </a>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $data_buku->links('pagination::bootstrap-5') }}
    </div>

    <p> Jumlah data buku: <strong>{{ $jumlahBuku }}</strong></p>
    <p>Total harga semua buku:<strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></p>
<!-- 

    <h1>5 Buku Terbaru</h1>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tanggal Ditambahkan</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($bukuTerbaru as $index => $buku)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Filter Buku Berdasarkan Penulis</h1>

    <form method="GET" action="{{ url('/buku') }}">
        <label for="penulis">Nama Penulis:</label>

        <input
            type="text"
            name="penulis"
            id="penulis"
            value="{{ $nama_penulis }}"
            placeholder="Masukkan nama penulis"
        >

        <button type="submit">Filter</button>
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Genre</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($bukuFilter as $index => $buku)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->genre }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Buku dengan penulis tersebut tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h1>Statistik Harga Buku</h1>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Statistik</th>
                <th>Nilai</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Total Buku</td>
                <td>{{ $statistik['total_buku'] }}</td>
            </tr>

            <tr>
                <td>Total Harga</td>
                <td>Rp {{ number_format($statistik['total_harga'], 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Harga Tertinggi</td>
                <td>Rp {{ number_format($statistik['harga_tertinggi'], 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Harga Terendah</td>
                <td>Rp {{ number_format($statistik['harga_terendah'], 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h1>Pencarian Buku Berdasarkan Judul</h1>
     
    <form method="GET" action="{{ url('/buku') }}">
        <input
            type="text"
            name="keyword"
            value="{{ $keyword }}"
            placeholder="Cari judul buku"
        >

        <button type="submit">Cari</button>
    </form>

    @if ($keyword)
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Genre</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($hasilPencarian as $index => $buku)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->genre }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Buku dengan judul "{{ $keyword }}" tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>

</body>
</html>