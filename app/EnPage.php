<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnPage extends Model
{
    protected $table="en_pages";
    protected $fillable = [
        "name",
        "page_id"
    ];
}
