<?php
namespace App\Service;
use App\Repository\ContohRepository;
class ContohService implements BaseService
{
    //nek error barne soale gae php lawas!
    public ContohRepository $r;
    function __construct()
    {
        $this->r = new ContohRepository();
        
    }
    public function getData()
    {
        
    }
    public function insertData($data)
    {

    }
    public function updateData($id, $data)
    {

    }
    public function deleteData($id)
    {

    }
}