@extends('layouts.app')

@section('content')
@component('components.breadcrumb')
    @slot('title', 'Makam')
    <li class="breadcrumb-item"><a href="#">Marketplace</a></li>
    <li class="breadcrumb-item active">Makam</li>
    @slot('button', '')
@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row">
                @foreach ($makams as $makam)
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('marketplace.show', $makam->id) }}">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="/storage/makam/{{ $makam->foto }}"
                                alt="Card image cap" style="height: 200px;">
                            <div class="card-body">
                                <h4 class="card-title">{{ $makam->nama }}</h4>
                                <p class="card-text">
                                    Harga : {{ $makam->harga_rupiah }}<br>
                                    Stok : {{ $makam->stok }}
                                </p>
                            </div>
                        </div>
                    </a>
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