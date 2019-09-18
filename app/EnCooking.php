<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnCooking extends Model
{
    protected $table="en_cooking";
    protected $fillable=[
        "cooking_id",
        "title",
        "description",
        "properties"
    ];
    protected $casts=[
        "properties" => "array"
    ];
}
