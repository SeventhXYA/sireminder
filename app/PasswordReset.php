<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $primaryKey = 'token';
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
