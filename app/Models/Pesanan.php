<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pemesan(){
        return $this->belongsTo(Pemesan::class);
    }

    public function pembayaran(){
        return $this->hasOne(Pembayaran::class);
    }

    public function homestay(){
        return $this->belongsTo(Homestay::class);
    }
}
