<?php

namespace App\Services;

use App\Models\Dosage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DosageService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Dosage();
    }

    public function findAll(Request $request): Collection {
        return Dosage::with(['product', 'culture', 'prague'])->get();
    }

    public function find(int $id): Dosage {
        if (!$dosage = Dosage::with(['product', 'culture', 'prague'])->find($id)) {
            throw new ModelNotFoundException("Dosage with id $id doesn't exists!" );
        }

        return $dosage;
    }
}
