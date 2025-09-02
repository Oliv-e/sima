<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasIdulFitri extends Model
{
    protected $table = 'petugas_idul_fitri';
    protected $fillable = [
        'khatib',
        'imam',
        'bilal',
        'moderator'
    ];
}
