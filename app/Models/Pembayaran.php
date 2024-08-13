<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = "tb_pembayaran";
    protected $primaryKey = "kode_bayar";
    public $incrementing = false;

    use HasFactory;

    public function penghuni()
    {
        return $this->hasOne(Penghuni::class, 'NIK', 'NIK');
    }

}
