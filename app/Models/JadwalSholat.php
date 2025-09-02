<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalSholat extends Model
{
    protected $table = 'jadwal_sholat';
    protected $fillable = ['tanggal','imsak','subuh','terbit','dhuha','dzuhur','ashar','maghrib','isya'];
}
