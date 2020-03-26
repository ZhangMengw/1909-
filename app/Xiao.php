<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xiao extends Model
{
    protected $table="xiao";
    protected $primaryKey = "x_id";
    public $timestamps = false;
    protected $guarded = [];
}
