<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //inisialisasi tabel dan kolom apa saja yang bisa dimasukan data
    use HasFactory;
    protected $table = 'tb_role';
    protected $fillable = [
        'role',
    ];

    //relasi dengan tabel user Many to One 
    //1 (baris data pada tabel) role bisa memiliki banyak (baris data) user
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
