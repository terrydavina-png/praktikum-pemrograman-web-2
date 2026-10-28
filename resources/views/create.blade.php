@extends('layouts.app')

@section('title', 'Tambah Buku')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker.min.css">
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4">Tambah Buku</h4>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('buku.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}">
                        </div>

                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis') }}">
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control" value="{{ old('harga') }}">
                        </div>

                        <div class="mb-3">
                            <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                            <input type="text" name="tgl_terbit" id="tgl_terbit" class="form-control" value="{{ old('tgl_terbit') }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/buku" class="btn btn-outline-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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