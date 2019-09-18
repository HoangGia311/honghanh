<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViProduct extends Model
{
    protected $table="vi_products";
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
