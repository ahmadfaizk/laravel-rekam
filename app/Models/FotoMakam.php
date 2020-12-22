<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoMakam extends Model
{
    protected $table = 'foto_makam';

    protected $fillable = [
        'foto',
        'id_makam'
    ];

    public function makam() {
        return $this->belongsTo(Makam::class, 'id_makam');
    }
}
