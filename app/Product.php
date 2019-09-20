<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";
    protected $fillable=[
        "primary_image",
    ];

    public function en(){
        return $this->hasOne('App\EnProduct','product_id','id');
    }
    public function vi(){
        return $this->hasOne('App\ViProduct','product_id','id');
    }
    public function image(){
        return $this->hasOne('App\Image','id','primary_image');
    }

    protected $appends=['alias','meta'];

    public function getAliasAttribute()
    {
        $alias = Alias::where('type','product')->where('object_id',$this->id)->first();
        if($alias){
            return $alias->alias;
        }
        return '';
    }

    public function getMetaAttribute()
    {
        $seo = Seo::where('type','product')->where('object_id',$this->id)->first();
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
