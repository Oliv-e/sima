<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasTarawih extends Model
{
    protected $table = 'petugas_tarawih';
    protected $fillable = [
        'imam',
        'kultum',
        'sholawat'
    ];
}
