<?php

namespace App\Http\Controllers\Api;

use App\Gallery;
use App\Http\Responses\APIResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class GalleryController extends Controller
{
    public function index(Request $request){
    	$keyword = $request->input('keyword','');
        $query = Gallery::query();
        if($keyword){
            $query->where("name","like","%$keyword%");
        }
        $galleries = $query->get();
        return APIResponse::success($galleries);
    }
    public function create(){
        $galleries = Gallery::all(["name","id"]);
        return APIResponse::success(compact('galleries'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $gallery = Gallery::create($request->all());
        return APIResponse::success($gallery);
    }

    public function edit(Gallery $gallery){
        $galleries = Gallery::where("id","!=",$gallery->id)->get(["name","id"]);
        return APIResponse::success(compact('galleries','gallery'));
    }

    public function update(Request $request,Gallery $gallery){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $gallery->update($request->all());
        return APIResponse::success($gallery);
    }

    public function destroy(Gallery $gallery){
        $children = $gallery->children();
        foreach ($children as $row){
            $row->images()->update(['gallery_id' => null]);
        }
        $children->delete();
        $gallery->images()->update(['gallery_id' => null]);
        $gallery->delete();
        return APIResponse::success([],'Delete gallery successfully');
    }
}
