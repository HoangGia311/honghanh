<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cooking extends Model
{
    protected $table="cooking";
    protected $fillable=[
        "link",
        "primary_image"
    ];

    public function en(){
        return $this->hasOne('App\EnCooking','cooking_id','id');
    }
    public function vi(){
        return $this->hasOne('App\ViCooking','cooking_id','id');
    }

    protected $appends=['alias','meta'];

    public function getAliasAttribute()
    {
        $alias = Alias::where('type','cooking')->where('object_id',$this->id)->first();
        if($alias){
            return $alias->alias;
        }
        return '';
    }

    public function getMetaAttribute()
    {
        $seo = Seo::where('type','cooking')->where('object_id',$this->id)->first();
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
