<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    //inisialisasi tabel dan kolom apa saja yang bisa dimasukan data
    use HasFactory;
    protected $table = 'tb_tempsuratmasuk';
    protected $fillable = [
        'user_id',
        'pengirim',
        'no_surat',
        'tgl_surat',
        'perihal',
        'id_status',
        'id_rencanakerja',
        'deleted_by'
    ];

    //relasi dengan tabel user Many to One
    //karena tabel surat masuk memiliki id dari tabel user (foreign key), maka menggunakan belongsTo untuk melakukan relasi
    //foreign key nya tidak dipanggil karena nama foreign key xsudah sesuai dengan format dari laravel
    //foreign key anjuran laravel adalah kata id berada diakhir
    //contoh ajuran user_id atau jabatan_id, jika id_user atau id_jabatan, foreign key nya harus dipanggil terlebih dahulu
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relasi dengan tabel rencana kerja One to One
    //karena tabel surat masuk memiliki id dari tabel rencana kerja (foreign key), maka menggunakan belongsTo untuk melakukan relasi
    //dan memanggil foreign key nya 
    public function rencanakerja()
    {
        return $this->belongsTo(RencanaKerja::class, 'id_rencanakerja');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
