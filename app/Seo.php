<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';
    protected $fillable = ['object_id','type','meta_title','meta_description','meta_keyword'];
}
