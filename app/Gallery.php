<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table="gallery";
    protected $fillable=[
        "name",
        "parent_id"
    ];

    public function children(){
        return $this->hasMany('App\Gallery','parent_id','id');
    }

    public function images(){
        return $this->hasMany('App\Image','gallery_id','id');
    }
}
