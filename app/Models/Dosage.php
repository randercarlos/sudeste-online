<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosage extends Model
{
    const RECORDS_PER_PAGE = 10;
    protected $table = 'dosages';
    protected $fillable = ['dosage', 'product_id', 'culture_id', 'prague_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function culture()
    {
        return $this->belongsTo(Culture::class);
    }

    public function prague()
    {
        return $this->belongsTo(Prague::class);
    }
}
