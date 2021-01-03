@extends('layouts.app')

@section('content')
@component('components.breadcrumb')
@slot('title', 'Konfirmasi Pembelian Makam')
<li class="breadcrumb-item"><a href="#">Masketplace</a></li>
<li class="breadcrumb-item"><a href="{{ route('marketplace.index') }}">Makam</a></li>
<li class="breadcrumb-item active">Konfirmasi Pembelian</li>
@slot('button', '')
@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title">Konfirmasi Pembelian</h4>
                            <p class="card-text">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td scope="col">Nama</td>
                                            <td scope="col">Harga</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="col">{{ $makam->nama }}</td>
                                            <td scope="col">{{ $makam->harga_rupiah }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td scope="col"><b>Total</b></td>
                                            <td scope="col">{{ $makam->harga_rupiah }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('marketplace.index') }}" class="btn btn-light">Batal</a>
                        <form action="{{ route('transaksi.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $makam->id }}">
                            <input type="submit" value="Bayar" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
