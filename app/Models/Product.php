<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    const RECORDS_PER_PAGE = 10;
    protected $table = 'products';
    protected $fillable = ['name'];
}
