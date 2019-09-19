<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViPage extends Model
{
    protected $table="vi_pages";
    protected $fillable = [
        "name",
        "page_id"
    ];
}
