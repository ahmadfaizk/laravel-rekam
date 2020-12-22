<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Makam extends Model
{
    protected $table = 'makam';

    protected $fillable = [
        'nama',
        'alamat',
        'stok',
        'deskripsi',
        'harga',
        'id_user',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan'
    ];

    public function provinsi() {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    public function kabupaten() {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }

    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function paketTambahan() {
        return $this->hasMany(PaketTambahan::class, 'id_makam');
    }

    public function foto() {
        return $this->hasMany(FotoMakam::class, 'id_makam');
    }
}
