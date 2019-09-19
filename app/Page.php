<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table="pages";
    protected $fillable=[
        "primary_image",
        "is_show",
        "code"
    ];
    public function en(){
        return $this->hasOne('App\EnPage','page_id','id');
    }
    public function vi(){
        return $this->hasOne('App\ViPage','page_id','id');
    }

    public function component(){
        return $this->hasMany('App\Component','page_id','id');
    }
}
