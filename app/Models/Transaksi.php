<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'status',
        'total_transaksi',
        'bukti_transfer',
        'tgl_transaksi',
        'id_user',
        'id_makam'
    ];

    public function makam() {
        return $this->belongsTo(Makam::class, 'id_makam');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function paketTambahan() {
        return $this->belongsToMany(PaketTambahan::class, 'transaksi_paket_tambahan', 'id_transaksi', 'id_paket_tambahan');
    }
}
