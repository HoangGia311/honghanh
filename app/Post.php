<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = [
        "category_id",
        "primary_image"
    ];
    public function en(){
        return $this->hasOne('App\EnPost','post_id','id');
    }
    public function vi(){
        return $this->hasOne('App\ViPost','post_id','id');
    }
    public function category(){
        return $this->hasOne('App\Category','id','category_id');
    }

    protected $appends=['alias','meta'];

    public function getAliasAttribute()
    {
        $alias = Alias::where('type','post')->where('object_id',$this->id)->first();
        if($alias){
            return $alias->alias;
        }
        return '';
    }

    public function getMetaAttribute()
    {
        $seo = Seo::where('type','post')->where('object_id',$this->id)->first();
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
    
}
