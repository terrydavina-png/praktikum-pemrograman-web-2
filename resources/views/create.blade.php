<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h4>Tambah Buku</h4>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('buku.store') }}">
        @csrf

        <div>Judul: <input type="text" name="judul"></div>
        <div>Penulis: <input type="text" name="penulis"></div>
        <div>Harga: <input type="text" name="harga"></div>
        <div>Tanggal Terbit: <input type="text" name="tgl_terbit" id="tgl_terbit" class="form-control"></div>

        <div>
            <button type="submit">Simpan</button>
        </div>

        <a href="{{ '/buku' }}">Kembali</a>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    $('#tgl_terbit').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
</script>
