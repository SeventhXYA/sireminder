<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;


class User extends Authenticatable
{
    //inisialisasi tabel dan kolom apa saja yang bisa dimasukan data
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_user';
    protected $fillable = ['username', 'password', 'email', 'id_role'];

    //relasi dengan tabel rencana kerja Many to One
    //karena tabel user memiliki id dari tabel rencana kerja (foreign key), maka menggunakan belongsTo untuk melakukan relasi
    //dan memanggil foreign key nya 
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    //relasi dengan tabel rencana kerja One to One
    //karena tabel user memiliki id dari tabel rencana kerja (foreign key), maka menggunakan belongsTo untuk melakukan relasi
    //dan memanggil foreign key nya 
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class);
    }

    //relasi dengan tabel surat masuk Many to One 
    //1 (baris data pada tabel) user bisa memiliki banyak (baris data) surat masuk
    public function suratmasuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    public function password_reset()
    {
        return $this->hasOne(PasswordReset::class);
    }
    //bawaan laravel
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
