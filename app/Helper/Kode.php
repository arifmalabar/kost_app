<?php
namespace App\Helper;

use Illuminate\Database\Eloquent\Model;

class Kode 
{
    public static function getCustomCode(Model $model, $first, $pk)
    {
        $newcode = "";
        $lastcode = $model::latest($pk)->first();
        if($model::count() == 0) {
            $newcode = $first."001";
        } else {
            $number = intval(substr($lastcode->kode_gedung, 1)) + 1;
            $newcode = $first . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
        return $newcode;
    }
}
