<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gedung extends Model
{
    use HasFactory;
    protected $table = "tb_gedung";
    protected $primaryKey = "kode_gedung";

    public function ruangan()
    {
        return $this->belongsTo(Kamar::class, 'kode_gedung', 'kode_gedung');
    }
}
