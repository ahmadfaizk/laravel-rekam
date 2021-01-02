@extends('layouts.app')

@section('content')
@component('components.breadcrumb')
    @slot('title', 'Transaksi')
    <li class="breadcrumb-item"><a href="#">Transaksi Saya</a></li>
    <li class="breadcrumb-item active">Makam</li>
    @slot('button', '')
@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td scope="col">No.</td>
                        <td scope="col">Nama</td>
                        <td scope="col">Status</td>
                        <td scope="col">Harga</td>
                        <td scope="col">Waktu Transaksi</td>
                        <td scope="col">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $transaksi)
                    <tr>
                        <td scope="col">{{ $loop->iteration }}</td>
                        <td scope="col">{{ $transaksi->nama_makam }}</td>
                        <td scope="col">{{ $transaksi->status }}</td>
                        <td scope="col">{{ $transaksi->total_transaksi }}</td>
                        <td scope="col">{{ $transaksi->waktu_transaksi }}</td>
                        <td scope="col">
                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $transaksis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
