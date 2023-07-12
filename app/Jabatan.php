<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //inisialisasi tabel dan kolom apa saja yang bisa dimasukan data
    use HasFactory;
    protected $table = 'tb_jabatan';
    protected $fillable = [
        'jabatan',
    ];

    //relasi dengan tabel pegawai Many to One 
    //1 (baris data pada tabel) jabatan memiliki banyak (baris data) pegawai
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
