@section('content')
    <div class="container mt-5">
        <h4>Tambah Buku</h4>
        <form method="POST" action="{{ route('buku.store') }}">
            @csrf
            <div>Judul: <input type="text" name="judul"></div>
            <div>Penulis: <input type="text" name="penulis"></div>
            <div>Harga: <input type="text" name="harga"></div>
            <div>Tanggal Terbit: <input type="date" name="tanggal_terbit"></div>
            <div><button type="submit">Simpan</button></div>
            <a href="{{'/buku'}}">Kembali</a>
        </form>
    </div>
@endsection