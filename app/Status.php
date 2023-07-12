<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'tb_status';
    protected $fillable = [
        'kategori',
        'status',
    ];

    public function suratmasuk()
    {
        return $this->hasOne(SuratMasuk::class);
    }
    public function tempsuratmasuk()
    {
        return $this->hasOne(Temp::class);
    }
}
