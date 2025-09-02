<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasIdulAdha extends Model
{
    protected $table = 'petugas_idul_adha';
    protected $fillable = [
        'khatib',
        'imam',
        'bilal',
        'moderator'
    ];
}
