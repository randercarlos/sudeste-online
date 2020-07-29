<?php

namespace App\Services;

use App\Models\Culture;

class CultureService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Culture();
    }
}
