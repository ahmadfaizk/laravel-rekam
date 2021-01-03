@extends('layouts.app')

@push('css')
<link href="{{ asset('assets/libs/filepond/filepond.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/filepond/filepond-plugin-image-preview.css') }}" rel="stylesheet">
@endpush

@section('content')
@component('components.breadcrumb')
    @slot('title', 'Edit Makam')
    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
    <li class="breadcrumb-item"><a href="{{ route('makam.index') }}">Makam</a></li>
    <li class="breadcrumb-item active">Edit</li>
    @slot('button', '')
@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('makam.update', $makam->id) }}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="foto">Foto Makam</label>
                                    <input class="form-control-file @error('foto') is-invalid @enderror" type="file"
                                        name="foto" id="foto">
                                    @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Makam</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" type="text"
                                        name="nama" id="nama" value="{{ old('nama') ?? $makam->nama }}" required>
                                    @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input class="form-control @error('harga') is-invalid @enderror" type="number"
                                        name="harga" id="harga" value="{{ old('harga') ?? $makam->harga }}" required>
                                    @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input class="form-control @error('stok') is-invalid @enderror" type="number"
                                        name="stok" id="stok" value="{{ old('stok') ?? $makam->stok }}" required>
                                    @error('stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <select class="form-control" name="provinsi" id="provinsi">
                                        @foreach ($provinsis as $provinsi)
                                        <option value="{{ $provinsi->id }}" {{ ($provinsi->id == $makam->id_provinsi) ? 'selected' : '' }}>{{ $provinsi->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten</label>
                                    <select class="form-control" name="kabupaten" id="kabupaten">
                                        @foreach ($kabupatens as $kabupaten)
                                        <option value="{{ $kabupaten->id }}" {{ ($kabupaten->id == $makam->id_kabupaten) ? 'selected' : '' }}>{{ $kabupaten->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kabupaten')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-control" name="kecamatan" id="kecamatan">
                                        @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}" {{ ($kecamatan->id == $makam->id_kecamatan) ? 'selected' : '' }}>{{ $kecamatan->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                id="alamat" rows="3" required>{{ old('alamat') ?? $makam->alamat }}</textarea>
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                id="deskripsi" rows="3">{{ old('deskripsi') ?? $makam->deskripsi }}</textarea>
                            @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('makam.index') }}" class="btn btn-light">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('assets/libs/ckeditor5/ckeditor.js') }}"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#provinsi').on('change', function () {
            var id = $(this).val();
            requestKabupaten(id);
        })
        $('#kabupaten').on('change', function () {
            var id = $(this).val();
            requestKecamatan(id);
        })

        function requestKabupaten(id) {
            $('#kabupaten').empty();
            $.get('/provinsi/' + id, function (data) {
                data.kabupaten.forEach(kabupaten => {
                    var option = new Option(kabupaten.nama, kabupaten.id);
                    $('#kabupaten').append(option);
                });
                requestKecamatan(data.kabupaten[0].id);
            })
        }

        function requestKecamatan(id) {
            $('#kecamatan').empty();
            $.get('/kabupaten/' + id, function (data) {
                data.kecamatan.forEach(kecamatan => {
                    var option = new Option(kecamatan.nama, kecamatan.id);
                    $('#kecamatan').append(option);
                });
            })
        }

        ClassicEditor
            .create(document.querySelector('#deskripsi'), {
                toolbar: ['heading', '|', 'bold', 'italic', '|', 'bulletedList', 'numberedList', '|',
                    'blockQuote', 'link'
                ]
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.log(error);
            });
    });

</script>
@endpush
