<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pemesan(){
        return $this->belongsTo(Pemesan::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function pesanan(){
        return $this->belongsTo(Pesanan::class);
    }
}
