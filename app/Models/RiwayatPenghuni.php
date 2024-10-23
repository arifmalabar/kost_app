<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenghuni extends Model
{
    use HasFactory;
    protected $table = "tb_riwayat_penghuni";
    public $timestamps = false;
    public $incrementing = false;
}
