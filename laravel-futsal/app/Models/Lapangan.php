<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function menyewa() {
        return $this->hasMany(Transaksi::class,'kode_lapangan');
    }
    
    function jadwal(){
        return $this->belongsTo(Jadwal::class,'kode_jadwal');
    }
}
