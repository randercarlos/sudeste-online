<?php

namespace App\Services;

use App\Models\Dosage;
use Illuminate\Support\Collection;

class ReportService
{
    public function findAll(): Collection {
        return Dosage::with(['product', 'culture', 'prague'])->orderBy('id')->get();
    }
}
