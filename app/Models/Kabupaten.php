<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';

    protected $fillable = [
        'id_provinsi', 'nama'
    ];

    public $timestamps = false;

    public function provinsi() {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    public function kecamatan() {
        return $this->hasMany(Kecamatan::class, 'id_kabupaten');
    }
}
