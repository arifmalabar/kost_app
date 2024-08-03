<?php

namespace App\Repository;
use App\Models\ContohModel;
use App\Repos\BaseRepository;
class ContohRepository extends BaseRepository
{
    function __construct()
    {
        parent::$model = new ContohModel();
    }
}