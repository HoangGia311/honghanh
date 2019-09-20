<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\EnCategory;
use App\Seo;
use App\ViCategory;
use App\Alias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\APIResponse;
use Validator;

class CategoryController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword','');
        $limit = (int)$request->input('limit',config("constants.ITEM_PER_PAGE"));
        $query = Category::query();
        // if(!empty($keyword)){
        //     $query->where(function($query)use($keyword){
        //         $query->where("code","like","%$keyword%");
        //     });
        // }
        $categories = $query->paginate($limit);	
        return APIResponse::success($categories);
    }

    public function create(){
        $categories = Category::all();
        return APIResponse::success(compact('categories'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'vi' => 'required|array',
            'vi.name' => 'required|max:191',
            'en' => 'required|array',
            'en.name' => 'required|max:191',
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $category = Category::create($data);
        if($category){
            $path = '/'.$category->id;
            if(!empty($category->parent_id)){
                $parent = Category::find($category->parent_id);
                if($parent){
                    $path = $parent->path.$path;
                }
            }
            $category->path = $path;
            $category->save();
            ViCategory::create([
                "name" => $data['vi']['name'],
                "category_id" => $category->id
            ]);
            EnCategory::create([
                "name" => $data['en']['name'],
                "category_id" => $category->id
            ]);
            $alias = !empty($data['alias']) ? $data['alias'] : to_slug($data['vi']['name']);
            Alias::create([
                'alias' => $alias,
                'object_id' => $category->id,
                'type'  => 'category'
            ]);
            Seo::create([
                'object_id' => $category->id,
                'type' => 'category',
                'meta_title' => isset($data['meta']) && isset($data['meta']['meta_title'])  ? $data['meta']['meta_title'] : '',
                'meta_description' => isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '',
                'meta_keyword' => isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '',
            ]);
            $response = Category::with(['en','vi'])->find($category->id);
            return APIResponse::success($response);
        }
        return APIResponse::fail();
        
    }

    public function edit(Category $category){
        $categories =  Category::where('id','!=',$category->id)->get();
        $category->load(['en','vi']);
        return APIResponse::success(compact('categories','category'));
    }

    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        if ($category) {
            $validator = Validator::make($request->all(), [
                'vi'    => 'required|array',
                'vi.name' => 'required|max:191',
                'en'       => 'required|array',
                'en.name' => 'required|max:191',
            ]);
            if ($validator->fails()) {
                return APIResponse::fail([], $validator->errors()->first());
            }
            $data = $request->all();

            $category->parent_id = isset($data['parent_id']) ? $data['parent_id'] : null;
            $path = '/' . $category->id;
            if (!empty($category->parent_id)) {
                $parent = Category::find($category->parent_id);
                if ($parent) {
                    $path = $parent->path . $path;
                }
            }
            $category->path = $path;
            $category->save();
            $vi_category = ViCategory::where('category_id', $category->id)->first();
            if ($vi_category) {
                $vi_category->name = $data['vi']['name'];
                $vi_category->save();
            } else {
                ViCategory::create([
                    "name" => $data['vi']['name'],
                    "category_id" => $category->id
                ]);
            }
            $en_category = EnCategory::where('category_id', $category->id)->first();
            if ($en_category) {
                $en_category->name = $data['en']['name'];
                $en_category->save();
            } else {
                EnCategory::create([
                    "name" => $data['en']['name'],
                    "category_id" => $category->id
                ]);
            }

            $alias = !empty($data['alias']) ? $data['alias'] : to_slug($data['vi']['name']);
            $update_alias = Alias::where('type', 'category')->where("object_id", $category->id)->first();
            if ($update_alias) {
                $update_alias->alias = $alias;
                $update_alias->save();
            } else {
                Alias::create([
                    'alias' => $alias,
                    'object_id' => $category->id,
                    'type' => 'category'
                ]);
            }
            $update_seo = Seo::where('type', 'category')->where("object_id", $category->id)->first();
            if ($update_seo) {
                $update_seo->meta_title = isset($data['meta']) && isset($data['meta']['meta_title']) ? $data['meta']['meta_title'] : '';
                $update_seo->meta_description = isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '';
                $update_seo->meta_keyword = isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '';
                $update_seo->save();
            } else {
                Seo::create([
                    'object_id' => $category->id,
                    'type' => 'category',
                    'meta_title' => isset($data['meta']) && isset($data['meta']['meta_title']) ? $data['meta']['meta_title'] : '',
                    'meta_description' => isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '',
                    'meta_keyword' => isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '',
                ]);
            }
            $response = Category::with(['en','vi'])->find($category->id);
            return APIResponse::success($response);
        }
        return APIResponse::fail([],'Category not found');
    }

    public function destroy(Category $category)
    {
        ViCategory::where("category_id",$category->id)->delete();
        EnCategory::where("category_id",$category->id)->delete();
        Alias::where("type",'cateogry')->where("object_id",$category->id)->delete();
        Seo::where("type",'cateogry')->where("object_id",$category->id)->delete();
        $category->children()->delete();
        $category->posts()->delete();
        $category->delete();
        return APIResponse::success([],'Delete category successfully!');
    }
}
