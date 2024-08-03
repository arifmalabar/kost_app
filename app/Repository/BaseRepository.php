<?php
namespace App\Repos;
use App\DataInterface\DataInterface;


abstract class BaseRepository implements DataInterface
{
    public $model;

    public function getAllData()
    {
        return $this->model->all();
    }

    public function simpanData($array)
    {
        return $this->model->create($array);
    }

    public function updateData($array, $id)
    {
        return $this->model->find($id)->update($array);
    }

    public function hapusData($id)
    {
        return $this->model->find($id)->delete();
    }

    public function hitung()
    {
        return $this->model->count();
    }

    public function cari($data)
    {
        // TODO: Implement cari() method.
    }

}