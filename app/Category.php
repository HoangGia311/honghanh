<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = ['code','parent_id','primary_image','path'];

    public $appends = ['vi_name','en_name','alias','meta'];

    public function getViNameAttribute()
    {

        $vi = ViCategory::where('category_id',$this->id)->first();
        if($vi){
            return $vi->name;
        }
        return '';
    }

    public function getEnNameAttribute()
    {
        $en = EnCategory::where('category_id',$this->id)->first();
        if($en){
            return $en->name;
        }
        return '';
    }

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
}
