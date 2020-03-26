<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //表明
    protected $table = 'brand';
    //主键
    protected $primaryKey = 'brand_id';
    public $timestamps = false;
    protected $guarded = [];
}
