<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Kamar;

class Penghuni extends Model
{
    use HasFactory;
    protected $table = "tb_biodata_penghuni";
    protected $primaryKey = "NIK";

    public function ruangan()
    {
        return $this->hasOne(Kamar::class, 'kode_kamar', 'kode_kamar');
    }
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'NIK', 'NIK');
    }
}
