<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pesanan(){
        return $this->hasMany(Pesanan::class);
    }

    public function pembayaran(){
        return $this->hasMany(Pembayaran::class);
    }

    public function ulasan(){
        return $this->hasMany(Ulasan::class);
    }
}
