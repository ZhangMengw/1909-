<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journ extends Model
{
    protected $table="journ";
    protected $primaryKey = "journ_id";
    public $timestamps = false;
    protected $guarded = [];
}
