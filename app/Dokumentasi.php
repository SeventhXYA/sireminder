<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;
    protected $table = 'tb_dokumentasi';
    protected $fillable = [
        'foto'
    ];

    public function rencanakerja()
    {
        return $this->hasOne(RencanaKerja::class);
    }
}
