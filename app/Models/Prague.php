<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prague extends Model
{
    const RECORDS_PER_PAGE = 10;
    protected $table = 'pragues';
    protected $fillable = ['name'];
}
