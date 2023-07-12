<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //inisialisasi tabel dan kolom apa saja yang bisa dimasukan data
    use HasFactory;
    protected $table = 'tb_pegawai';
    protected $fillable = [
        'nama_pegawai', 'jk', 'nohp', 'id_jabatan', 'user_id'
    ];

    //relasi dengan tabel jabatan Many to One
    //karena tabel pegawai memiliki id dari tabel jabatan (foreign key), maka menggunakan belongsTo untuk melakukan relasi
    //dan memanggil foreign key nya 
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    //relasi dengan tabel user One to One
    //1 (baris data) tabel pegawai hanya bisa memiliki 1 (baris data) tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
