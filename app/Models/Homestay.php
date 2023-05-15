<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pemilik(){
        return $this->belongsTo(Admin::class);
    }

    public function ulasan(){
        return $this->hasMany(Ulasan::class);
    }

    public function foto(){
        return $this->hasMany(Foto::class);
    }

    public function pesanan(){
        return $this->hasMany(Pesanan::class);
    }
}
