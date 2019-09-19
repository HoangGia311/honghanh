<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table="components";
    protected $fillable = [
        "code",
        "type",
        "content",
        "data",
        "page_id"
    ];
    const TYPE_SINGLE_IMAGE = "single_image";
	const TYPE_LIST_COOKING = "list_cooking";
	const TYPE_LIST_IMAGE ="list_image";
	const TYPE_TEXT ="text";
	const TYPE_LIST_PRODUCT="list_product";
	const TYPE_LIST_CATEGORY="list_category";
	const TYPE_LIST_POST="list_post";
	protected $casts=[
	    "data" => "array"
    ];
}
