<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = ['parent_id','primary_image','path'];

    public function en(){
        return $this->hasOne('App\EnCategory','category_id','id');
    }
    public function vi(){
        return $this->hasOne('App\ViCategory','category_id','id');
    }

    public $appends = ['alias','meta'];

    public function getAliasAttribute()
    {
        $alias = Alias::where('type','category')->where('object_id',$this->id)->first();
        if($alias){
            return $alias->alias;
        }
        return '';
    }

    public function getMetaAttribute()
    {
        $seo = Seo::where('type','category')->where('object_id',$this->id)->first();
        if($seo){
            return [
                "meta_title" => $seo->meta_title,
                "meta_description" => $seo->meta_description,
                "meta_keyword" => $seo->meta_keyword,
            ];
        }
        return [
            "meta_title" => '',
            "meta_description" => '',
            "meta_keyword" => '',
        ];
    }

    public function children(){
        return $this->hasMany('\App\Category','parent_id','id');
    }
    public function posts(){
        return $this->hasMany('\App\Post','category_id','id');
    }
    public function image(){
        return $this->hasOne('\App\Image','id','primary_image'); 
    }
}
