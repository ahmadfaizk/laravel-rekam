@extends('layouts.app')

@section('content')
@component('components.breadcrumb')
    @slot('title', 'Makam')
    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
    <li class="breadcrumb-item active">Makam</li>
    @slot('button')
    <a href="{{ route('makam.create') }}" class="btn btn-primary">Tambah Baru</a>
    @endslot
@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row">
                @foreach ($makams as $makam)
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="/storage/makam/{{ $makam->foto }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{ $makam->nama }}</h4>
                            <p class="card-text">{{ $makam->harga_rupiah }}</p>
                            <a href="javascript:void(0)" class="btn btn-primary">Lihat</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $makams->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
