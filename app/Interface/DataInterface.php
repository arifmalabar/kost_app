<?php
namespace App\DataInterface;
interface DataInterface
{
    public function getAllData();

    public function simpanData($array);

    public function updateData($array, $id);

    public function hapusData($id);
    public function hitung();
    public function cari($data);
}