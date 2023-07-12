<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaKerja extends Model
{
    //inisialisasi tabel dan kolom apa saja yang bisa dimasukan data
    use HasFactory;
    protected $table = 'tb_rencanakerja';
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'rencana',
        'lokasi',
        'kategori',
        'color',
        'id_dokumentasi',
    ];

    //relasi dengan tabel surat masuk One to One
    //1 (baris data) tabel rencana kerja hanya bisa memiliki 1 (baris data) tabel suratmasuk
    //begitu juga sebaliknya
    public function suratmasuk()
    {
        return $this->hasOne(SuratMasuk::class);
    }

    public function tempsuratmasuk()
    {
        return $this->hasOne(Temp::class);
    }

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class, 'id_dokumentasi');
    }

    //relasi dengan tabel user Many to One
    //karena tabel rencana kerja memiliki id dari tabel user (foreign key), maka menggunakan belongsTo untuk melakukan relasi
    //foreign key nya tidak dipanggil karena nama foreign key xsudah sesuai dengan format dari laravel
    //foreign key anjuran laravel adalah kata id berada diakhir
    //contoh ajuran user_id atau jabatan_id, jika id_user atau id_jabatan, foreign key nya harus dipanggil terlebih dahulu
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
