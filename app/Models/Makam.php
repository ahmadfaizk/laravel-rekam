<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Makam extends Model
{
    use SoftDeletes;
    
    protected $table = 'makam';

    protected $fillable = [
        'nama',
        'alamat',
        'stok',
        'deskripsi',
        'harga',
        'foto',
        'id_user',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan'
    ];

    public function getHargaRupiahAttribute() {
        return 'Rp. ' . number_format($this->harga, 2, ',', '.');
    }

    public function transaksi() {
        return $this->hasMany(Transaksi::class, 'id_makam');
    }

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
}
