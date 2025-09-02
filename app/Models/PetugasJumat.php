<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasJumat extends Model
{
    protected $table = 'petugas_jumat';
    protected $fillable = [
        'khatib',
        'imam',
        'muadzin',
        'bilal'
    ];
}
