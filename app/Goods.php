<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $primaryKey = "cate_id";
    public $timestamps = false;
    protected $guarded = [];
}
