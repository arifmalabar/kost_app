<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPembayaran extends Model
{
    use HasFactory;
    protected $table = "tb_riwayat_pembayaran";
    protected $primaryKey = "no_transaksi";
    public $timestamps = false;
    public $incrementing = false;

}
