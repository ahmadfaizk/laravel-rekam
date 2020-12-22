<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketTambahan extends Model
{
    protected $table = 'paket_tambahan';

    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'id_makam'
    ];

    public function makam() {
        return $this->belongsTo(Makam::class, 'id_makam');
    }
}
