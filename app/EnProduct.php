<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnProduct extends Model
{
    protected $table="en_products";
    protected $fillable=[
        "product_id",
        "name",
        "description",
        "properties"
    ];
    protected $casts=[
        "properties" => "array"
    ];
}
