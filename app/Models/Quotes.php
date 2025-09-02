<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    protected $table = 'quotes';
    protected $fillable = [
        'ditampilkan',
        'quote1',
        'quote2',
        'quote3',
    ];
}
