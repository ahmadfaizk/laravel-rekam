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
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group" aria-label="Action button">
                                <a href="{{ route('makam.show', $makam->id) }}" id="show" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                                <a href="{{ route('makam.edit', $makam->id) }}" id="edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="{{ route('makam.destroy', $makam->id) }}" id="delete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Hapus</a>
                            </div>
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

@section('modal')
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" method="post" id="delete-form">
            @csrf
            @method('delete')
            <div class="modal-body">
                Anda yakin ingin menghapus makam ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <button class="btn btn-primary">Ya, hapus sekarang!</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@push('script')
<script>
    $('#deleteModal').on('show.bs.modal', function (e) {
        $('#delete-form').attr('action', e.relatedTarget.getAttribute('href'));
    });
</script>
@endpush
