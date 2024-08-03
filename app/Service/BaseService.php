<?php
namespace App\Service;
interface BaseService {
    public function getData();
    public function insertData($data);
    public function updateData($id, $data);
    public function deleteData($id);
}