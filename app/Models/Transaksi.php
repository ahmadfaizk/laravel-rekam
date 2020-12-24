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
        'waktu_transaksi',
        'waktu_pembayaran',
        'id_user',
        'id_makam'
    ];

    public $timestamps = false;

    public function makam() {
        return $this->belongsTo(Makam::class, 'id_makam');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
