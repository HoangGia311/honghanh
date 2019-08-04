<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViCategory extends Model
{
    protected $table='vi_categories';
    protected $fillable = ["name","category_id"];
}
