<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
</head>
<body>
    <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>

    <h1>Data Buku</h1>
    <br> 

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
                    <td>{{ $buku->harga }}</td>
                    <td>{{ $buku->tgl_terbit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p> Jumlah data buku: <strong>{{ $jumlahBuku }}</strong></p>
    <p>Total harga semua buku:<strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></p>


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
    @endif

</body>
</html>