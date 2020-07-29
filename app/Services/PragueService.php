<?php

namespace App\Services;

use App\Models\Prague;

class PragueService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Prague();
    }
}
