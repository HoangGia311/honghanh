<?php

namespace App\Http\Controllers\Api;

use App\Gallery;
use App\Http\Responses\APIResponse;
use App\Image;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\UploadHelper;

class ImageController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword','');
        $limit = (int)$request->input('limit',config("constants.ITEM_PER_PAGE"));
        $query = Image::query();
        if($keyword){
            $query->where("name","like","%$keyword%");
        }
        $images = $query->paginate($limit);
        return APIResponse::success($images);
    }
    public function create(){
        $galleries = Gallery::all(['id','name']);
        return APIResponse::success(compact('galleries'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'images' => 'required|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $images = $data['images'];
        foreach ($images as $image){
            $path = UploadHelper::uploadImage($image);
            $name = $image->getClientOriginalName();
            $name = explode('.', $name);
            $name = $name[0];
            Image::create([
                "gallery_id" => isset($data['gallery_id']) ? (int)$data['gallery_id'] : null,
                "name" => $name,
                "path" => $path
            ]);
        }
        return APIResponse::success();
    }

    public function edit(Image $image){
        $galleries = Gallery::all(["id","name"]);
        return APIResponse::success(compact('galleries','image'));
    }
    public function update(Request $request,Image $image){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->only(['name','gallery_id']);
        $image->update($data);
        return APIResponse::success();
    }
    public function destroy(Image $image){
        $path =  str_replace(url(''),public_path(''),$image->path);
        if(file_exists($path)){
            unlink($path);
        }
        $image->delete();
        return APIResponse::success([],'delete image successfully');
    }
}
