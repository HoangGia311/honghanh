<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cooking;
use App\EnCooking;
use App\ViCooking;
use App\Alias;
use App\Seo;
use Validator;
use App\Http\Responses\APIResponse;

class CookingController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword','');
        $limit = (int)$request->input('limit',config("constants.ITEM_PER_PAGE"));
        $query = Cooking::query();

        $cooking = $query->with(["vi","en"])->paginate($limit);
        return APIResponse::success($cooking);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'vi'=>'array|required',
            'vi.title' => 'required|max:191',
            'vi.description' => 'required:max:191',
            'vi.properties' => 'required|array',
            'vi.properties.ingredients' => 'required|array',
            'vi.properties.ingredients.*.*' => 'required',
            'vi.properties.process' => 'required|array',
            'en'=>'array|required',
            'en.title' => 'required|max:191',
            'en.description' =>'required',
            'en.properties' => 'required|array',
            'en.properties.ingredients' => 'required|array',
            'en.properties.ingredients.*.*' => 'required',
            'en.properties.process' => 'required|array',
            'link' => 'required|max:191',
            'primary_image' => 'required'
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $cooking = Cooking::create($data);
        if($cooking){
            $data['vi']['cooking_id'] = $cooking->id;
            $data['en']['cooking_id'] = $cooking->id;
            ViCooking::create($data['vi']);
            EnCooking::create($data['en']);
            $alias = !empty($data['alias']) ? $data['alias'] : to_slug($data['vi']['title']);
            Alias::create([
                'alias' => $alias,
                'object_id' => $cooking->id,
                'type'  => 'cooking'
            ]);
            Seo::create([
                'object_id' => $cooking->id,
                'type' => 'cooking',
                'meta_title' => isset($data['meta']) && isset($data['meta']['meta_title'])  ? $data['meta']['meta_title'] : '',
                'meta_description' => isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '',
                'meta_keyword' => isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '',
            ]);
            $cooking = Cooking::with(['en','vi'])->find($cooking->id);
            return APIResponse::success($cooking);
        }
        return APIResponse::fail();
    }

    public function edit(Cooking $cooking){
        $cooking->load(['en','vi']);
        return APIResponse::success(compact('cooking'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'vi'=>'array|required',
            'vi.title' => 'required|max:191',
            'vi.description' => 'required:max:191',
            'vi.properties' => 'required|array',
            'vi.properties.ingredients' => 'required|array',
            'vi.properties.ingredients.*.*' => 'required',
            'vi.properties.process' => 'required|array',
            'en'=>'array|required',
            'en.title' => 'required|max:191',
            'en.description' =>'required',
            'en.properties' => 'required|array',
            'en.properties.ingredients' => 'required|array',
            'en.properties.ingredients.*.*' => 'required',
            'en.properties.process' => 'required|array',
            'link' => 'required|max:191',
            'primary_image' => 'required'
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $cooking = Cooking::find($id);
        if($cooking){
            $cooking->update($data);
            $vi_cooking = ViCooking::where('cooking_id',$id)->first();
            if($vi_cooking){
                $vi_cooking->update($data['vi']);
            }else{
                $data['vi']['cooking_id'] = $id;
                ViCooking::create($data['vi']);
            }
            $en_cooking = EnCooking::where('cooking_id',$id)->first();
            if($en_cooking){
                $en_cooking->update($data['en']);
            }else{
                $data['en']['cooking_id'] = $id;
                EnCooking::create($data['en']);
            }

            $alias = !empty($data['alias']) ? $data['alias'] : to_slug($data['vi']['title']);
            $update_alias = Alias::where('type', 'cooking')->where("object_id", $cooking->id)->first();
            if ($update_alias) {
                $update_alias->alias = $alias;
                $update_alias->save();
            } else {
                Alias::create([
                    'alias' => $alias,
                    'object_id' => $cooking->id,
                    'type' => 'cooking'
                ]);
            }
            $update_seo = Seo::where('type', 'cooking')->where("object_id", $cooking->id)->first();
            if ($update_seo) {
                $update_seo->meta_title = isset($data['meta']) && isset($data['meta']['meta_title']) ? $data['meta']['meta_title'] : '';
                $update_seo->meta_description = isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '';
                $update_seo->meta_keyword = isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '';
                $update_seo->save();
            } else {
                Seo::create([
                    'object_id' => $cooking->id,
                    'type' => 'cooking',
                    'meta_title' => isset($data['meta']) && isset($data['meta']['meta_title']) ? $data['meta']['meta_title'] : '',
                    'meta_description' => isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '',
                    'meta_keyword' => isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '',
                ]);
            }
            $response = Cooking::with(['en','vi'])->find($cooking->id);
            return APIResponse::success($response);
        }
        return APIResponse::fail([],'Cooking not found');
    }
    public function destroy(Cooking $cooking){
        $cooking->delete();
        return APIResponse::success();
    }
}
