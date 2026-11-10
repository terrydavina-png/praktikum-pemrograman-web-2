@extends('layouts.app')

@section('title', 'Edit Buku')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker.min.css">
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4">Edit Buku</h4>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control"
                                   value="{{ old('judul', $buku->judul) }}">
                        </div>

                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" id="penulis" class="form-control"
                                   value="{{ old('penulis', $buku->penulis) }}">
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control"
                                   value="{{ old('harga', $buku->harga) }}">
                        </div>

                        <div class="mb-3">
                            <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                            <input type="text" name="tgl_terbit" id="tgl_terbit" class="form-control"
                                   value="{{ old('tgl_terbit', $buku->tgl_terbit->format('Y-m-d')) }}">
                        </div>
                        <div>
                            <label for="cover" class="form-label">Cover</label>
                            @if ($buku->cover)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover {{ $buku->judul }}"
                                        class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                            <input type="file" name="cover" id="cover" class="form-control" accept="image/png,image/jpeg">
                            <div class="form-text">Kosongkan jika tidak ingin mengganti cover.</div>
                        </div>
                        <div>
                            <label for="PDF" class="form-label">File PDF</label>
                            @if ($buku->PDF)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $buku->PDF) }}" target="_blank">Lihat PDF</a>
                                </div>
                            @endif
                            <input type="file" name="PDF" id="PDF" class="form-control" accept="application/pdf">
                            <div class="form-text">Kosongkan jika tidak ingin mengganti file PDF.</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/buku" class="btn btn-outline-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('#tgl_terbit').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    </script>
@endpush