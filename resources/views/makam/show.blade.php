@extends('layouts.app')

@section('content')
@component('components.breadcrumb')
@slot('title', 'Detail Makam')
<li class="breadcrumb-item"><a href="#">Data Master</a></li>
<li class="breadcrumb-item"><a href="{{ route('makam.index') }}">Makam</a></li>
<li class="breadcrumb-item active">Detail</li>
@slot('button', '')
@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row mt-2 ml-2">
                    <div class="col-md-4">
                        <img class="img-fluid" src="/storage/makam/{{ $makam->foto }}" alt="Card image cap">
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $makam->nama }}</h4>
                    <p><span style="font-weight: 700">Harga : </span> {{ $makam->harga_rupiah }}</p>
                    <p><span style="font-weight: 700">Stok : </span> {{ $makam->stok }}</p>
                    <p><span style="font-weight: 700">Alamat : </span> {{ $makam->alamat }}</p>
                    <p><span style="font-weight: 700">Kecamatan : </span> {{ $makam->kecamatan->nama }}</p>
                    <p><span style="font-weight: 700">Kabupaten : </span> {{ $makam->kabupaten->nama }}</p>
                    <p><span style="font-weight: 700">Provinsi : </span> {{ $makam->provinsi->nama }}</p>
                    <p><span style="font-weight: 700">Deskripsi : </span><br> {!! $makam->deskripsi !!}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('makam.index') }}" class="btn btn-light">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
