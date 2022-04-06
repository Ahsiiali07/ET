<?php

namespace App\Services;

use App\Models\City;

class CityService extends BaseService
{
    /**
     * CityService constructor.
     */
    public function __construct()
    {
        $this->model= new City();
        parent::__construct();
    }

    /** @var $model */
    public $model;
}
