<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = "tb_kamar";
    protected $primaryKey = "kode_kamar";

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'kode_kamar', 'kode_kamar');
    }
    public function gedung()
    {
        return $this->hasOne(Gedung::class, 'kode_gedung', 'kode_gedung');
    }
}
