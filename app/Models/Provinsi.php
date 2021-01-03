<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';

    protected $fillable = [
        'nama'
    ];

    public $timestamps = false;

    public function kabupaten() {
        return $this->hasMany(Kabupaten::class, 'id_provinsi');
    }
}
