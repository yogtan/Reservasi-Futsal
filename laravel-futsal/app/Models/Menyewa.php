<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Menyewa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function user() {
        return $this->belongsTo(User::class,'id');
    }

    function jadwal(){
        return $this->belongsTo(Jadwal::class,'id');
    }

    function lapangan(){
        return $this->belongsTo(Lapangan::class,'id');
    }
    public static function isSewaExists($id_lapangan, $id_jadwal, $tanggal)
    {
        return Menyewa::where('id_lapangan', $id_lapangan)
            ->where('id_jadwal', $id_jadwal)
            ->whereDate('tanggal', Carbon::parse($tanggal)->format('Y-m-d'))
            ->exists();
    }
}
