<?php

namespace App\Services;

use App\Models\Country;

class CountryService extends BaseService
{
    /**
     * CountryService constructor.
     */
    public function __construct()
    {
        $this->model= new Country();
        parent::__construct();
    }

    /** @var $model */
    public $model;

    /**
     * @return Country[]
     */
    public static function allWithIdAndName(): array
    {
        return Country::all()->pluck( 'name', 'id' )->all();
    }
}
