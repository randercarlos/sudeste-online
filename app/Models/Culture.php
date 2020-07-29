<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    const RECORDS_PER_PAGE = 10;
    protected $table = 'cultures';
    protected $fillable = ['name'];
}
