<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnCategory extends Model
{
    protected $table='en_categories';
    protected $fillable = ["name","category_id"];
}
