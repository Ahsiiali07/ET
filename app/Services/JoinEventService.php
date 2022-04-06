<?php

namespace App\Services;

use App\Models\JoinEvent;

class JoinEventService extends BaseService
{

    /**
     * CategoryService constructor.
     */
    public function __construct() {
        $this->model = new JoinEvent();

        parent::__construct();
    }



}
