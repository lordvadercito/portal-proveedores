<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Romaneo extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre', 'uri'];
    protected $dates = ['created_at'];
}
