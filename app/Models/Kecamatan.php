<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        'id_kabupaten', 'nama'
    ];

    public $timestamps = false;

    public function kabupaten() {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }
}
