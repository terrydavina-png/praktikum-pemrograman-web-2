<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h4>Edit Buku</h4>

    <form method="POST" action="{{ route('buku.update', $buku->id) }}">
        @csrf
        @method('PUT')

        <div>
            Judul:
            <input type="text" name="judul" value="{{ $buku->judul }}">
        </div>

        <div>
            Penulis:
            <input type="text" name="penulis" value="{{ $buku->penulis }}">
        </div>

        <div>
            Harga:
            <input type="text" name="harga" value="{{ $buku->harga }}">
        </div>

        <div>
            Tanggal Terbit:
            <input type="text"
                   name="tgl_terbit"
                   id="tgl_terbit"
                   class="form-control"
                   value="{{ $buku->tgl_terbit->format('Y-m-d') }}">
        </div>

        <div>
            <button type="submit">Simpan Perubahan</button>
        </div>

        <a href="{{ '/buku' }}">Kembali</a>
    </form>
</div>