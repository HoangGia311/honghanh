<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnPost extends Model
{
    protected $table="en_posts";
    protected $fillable = [
        "post_id",
        "title",
        "description",
        "content"
    ];
}
