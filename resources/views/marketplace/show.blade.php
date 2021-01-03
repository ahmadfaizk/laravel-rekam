@extends('layouts.app')

@section('content')
@component('components.breadcrumb')
@slot('title', 'Detail Makam')
<li class="breadcrumb-item"><a href="#">Masketplace</a></li>
<li class="breadcrumb-item"><a href="{{ route('marketplace.index') }}">Makam</a></li>
<li class="breadcrumb-item active">Detail</li>
@slot('button', '')
@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <img class="img-fluid" src="/uploads/{{ $makam->foto }}" alt="Card image cap">
                        </div>
                        <div class="col-md-8 col-12">
                            <h4 class="card-title">{{ $makam->nama }}</h4>
                            <p class="card-text">
                                <table class="table table-borderless">
                                    <tr>
                                        <td scope="col">Penjual Makam</td>
                                        <td></td>
                                        <td scope="col">{{ $makam->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Harga</td>
                                        <td></td>
                                        <td scope="col">{{ $makam->harga_rupiah }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Stok</td>
                                        <td></td>
                                        <td scope="col">{{ $makam->stok }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Alamat</td>
                                        <td></td>
                                        <td scope="col">{{ $makam->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Provinsi</td>
                                        <td></td>
                                        <td scope="col">{{ $makam->provinsi->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Kabupaten</td>
                                        <td></td>
                                        <td scope="col">{{ $makam->kabupaten->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Kecamatan</td>
                                        <td></td>
                                        <td scope="col">{{ $makam->kecamatan->nama }}</td>
                                    </tr>
                                </table>
                                
                                Keterangan Makam : <br>
                                {!! $makam->deskripsi !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('marketplace.index') }}" class="btn btn-light">Kembali</a>
                        <a href="{{ route('marketplace.buy', $makam->id) }}" class="btn btn-success">Beli Makam</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
