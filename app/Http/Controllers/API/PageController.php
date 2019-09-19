<?php

namespace App\Http\Controllers\API;

use App\Http\Responses\APIResponse;
use App\Page;
use App\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PageController extends Controller
{
    public function index(){
        $pages = Page::with(["vi","en"])->get();
        return APIResponse::success($pages);
    }
    public function addComponent(Request $request){
    	$validator = Validator::make($request->all(), [
            "code" => "required",
            "type" => "required",
            "data" => "array",
            "page_id" => "required"
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $component = Component::create($data);
        return APIResponse::success($component);
    }
    public function deleteComponent($id){
    	Component::find($id)->delete();
    	return APIResponse::success();
    }
    public function listComponent(Request $request){
    	$page_id = (int)$request->get('page_id');
    	$query = Component::query();
    	if($page_id){
    		$query->where('page_id',$page_id);
    	}
    	$component = $query->get();
        return APIResponse::success($component);
    }
}
