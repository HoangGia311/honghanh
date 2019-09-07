<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViPost extends Model
{
    protected $table="vi_posts";
    protected $fillable = [
        "post_id",
        "title",
        "description",
        "content"
    ];
}
