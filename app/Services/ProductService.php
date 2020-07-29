<?php

namespace App\Services;

use App\Models\Product;

class ProductService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Product();
    }
}
