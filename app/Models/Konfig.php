<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konfig extends Model
{
    protected $table = "konfig";
    protected $fillable = [
        "name",
        "val",
        "dval",
    ];
}
