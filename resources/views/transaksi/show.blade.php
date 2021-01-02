@extends('layouts.app')

@section('content')
@component('components.breadcrumb')
@slot('title', 'Transaksi')
<li class="breadcrumb-item"><a href="#">Transaksi</a></li>
<li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Makam</a></li>
<li class="breadcrumb-item active">Detail</li>
@slot('button', '')
@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title">Detail Transaksi</h4>
                            <p class="card-text">
                                <table class="table table-borderless">
                                    @role('penjual')
                                    <tr>
                                        <td scope="col">Nama Pembeli</td>
                                        <td></td>
                                        <td scope="col">{{ $transaksi->user->name }}</td>
                                    </tr>
                                    @endrole
                                    <tr>
                                        <td scope="col">Nama Makam</td>
                                        <td></td>
                                        <td scope="col"><a href="{{ route('makam.show', $transaksi->makam->id) }}">{{ $transaksi->makam->nama }}</a></td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Harga</td>
                                        <td></td>
                                        <td scope="col">{{ $transaksi->total_transaksi }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Status</td>
                                        <td></td>
                                        <td scope="col">{{ $transaksi->status }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Waktu</td>
                                        <td></td>
                                        <td scope="col">{{ $transaksi->waktu_transaksi }}</td>
                                    </tr>
                                </table>
                            </p>
                        </div>
                    </div>

                    @role('penjual')
                    @if ($transaksi->status == 'Menunggu Verifikasi')
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">Bukti Transfer</h5>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <img src="/storage/transaksi/{{ $transaksi->bukti_transfer }}" class="img-fluid" alt="Bukti Transfer">
                                    </div>
                                </div>
                                <p class="card-text">Waktu Transfer : {{ $transaksi->waktu_pembayaran }}</p>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <form action="{{ route('transaksi.confirm-pembayaran') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $transaksi->id }}">
                                            <div class="d-flex justify-content-between">
                                                <div class="form-group">
                                                    <input type="submit" name="aksi" value="Tolak Pembayaran" class="btn btn-danger">
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" name="aksi" value="Setujui Pembayaran" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endrole

                    @role('pembeli')
                    @if ($transaksi->status == 'Belum Dibayar' || $transaksi->status == 'Gagal')
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">Konfirmasi Pembayaran</h5>
                                <form action="{{ route('transaksi.confirm') }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $transaksi->id }}">
                                    <div class="form-group">
                                        <label for="bukti">Bukti Transfer</label>
                                        <input class="form-control-file @error('bukti') is-invalid @enderror" type="file"
                                            name="bukti" id="bukti" required>
                                        @error('bukti')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Kirim" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @elseif($transaksi->status == 'Menunggu Verifikasi')
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">Bukti Transfer</h5>
                                <img src="/storage/transaksi/{{ $transaksi->bukti_transfer }}" class="img-fluid" alt="Bukti Transfer">
                                <p class="card-text">Waktu Transfer : {{ $transaksi->waktu_pembayaran }}</p>
                            </div>
                        </div>
                    @elseif($transaksi->status == 'Berhasil')
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">Cetak Bukti Pembelian</h5>
                                <a href="{{ route('transaksi.print', $transaksi->id) }}" class="btn btn-secondary">Cetak</a>
                            </div>
                        </div>
                    @endif
                    @endrole
                </div>
                <div class="card-footer">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-light">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
