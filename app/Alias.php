<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alias extends Model
{
    protected $table = "alias";
    protected $fillable = ['alias','object_id','type'];
}
