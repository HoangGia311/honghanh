<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViCooking extends Model
{
    protected $table="vi_cooking";
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
