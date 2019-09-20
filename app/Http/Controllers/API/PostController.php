<?php

namespace App\Http\Controllers\Api;

use App\Alias;
use App\Category;
use App\EnPost;
use App\Http\Responses\APIResponse;
use App\Post;
use App\Seo;
use App\ViPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PostController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword','');
        $limit = (int)$request->input('limit',config("constants.ITEM_PER_PAGE"));
        $query = Post::query();
        $query->with(['vi','en']);
        $posts = $query->paginate($limit);
        return APIResponse::success($posts);
    }
    public function create(){
        $categories = Category::all();
        return APIResponse::success(compact('categories'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'vi'=>'array|required',
            'vi.title' => 'required|max:191',
            'vi.description' => 'required:max:191',
            'vi.content' => 'required',
            'en'=>'array|required',
            'en.title' => 'required|max:191',
            'en.description' =>'required',
            'en.content' => 'required',
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $post = Post::create($data);
        if($post){
            $data['vi']['post_id'] = $post->id;
            $data['en']['post_id'] = $post->id;
            ViPost::create($data['vi']);
            EnPost::create($data['en']);
            $alias = !empty($data['alias']) ? $data['alias'] : to_slug($data['vi']['title']);
            Alias::create([
                'alias' => $alias,
                'object_id' => $post->id,
                'type'  => 'post'
            ]);
            Seo::create([
                'object_id' => $post->id,
                'type' => 'post',
                'meta_title' => isset($data['meta']) && isset($data['meta']['meta_title'])  ? $data['meta']['meta_title'] : '',
                'meta_description' => isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '',
                'meta_keyword' => isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '',
            ]);
            $post = Post::with(['en','vi'])->find($post->id);
            return APIResponse::success($post);
        }
        return APIResponse::fail();
    }

    public function edit(Post $post){
        $categories = Category::all();
        $post->load(['en','vi','image']);
        return APIResponse::success(compact('categories','post'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'vi'=>'array|required',
            'vi.title' => 'required|max:191',
            'vi.description' => 'required:max:191',
            'vi.content' => 'required',
            'en'=>'array|required',
            'en.title' => 'required|max:191',
            'en.description' =>'required',
            'en.content' => 'required',
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $post = Post::find($id);
        if($post){
            $post->update($data);
            $vi_post = ViPost::where('post_id',$id)->first();
            if($vi_post){
                $vi_post->update($data['vi']);
            }else{
                $data['vi']['post_id'] = $id;
                ViPost::create($data['vi']);
            }
            $en_post = EnPost::where('post_id',$id)->first();
            if($en_post){
                $en_post->update($data['en']);
            }else{
                $data['en']['post_id'] = $id;
                EnPost::create($data['en']);
            }

            $alias = !empty($data['alias']) ? $data['alias'] : to_slug($data['vi']['title']);
            $update_alias = Alias::where('type', 'post')->where("object_id", $post->id)->first();
            if ($update_alias) {
                $update_alias->alias = $alias;
                $update_alias->save();
            } else {
                Alias::create([
                    'alias' => $alias,
                    'object_id' => $post->id,
                    'type' => 'post'
                ]);
            }
            $update_seo = Seo::where('type', 'post')->where("object_id", $post->id)->first();
            if ($update_seo) {
                $update_seo->meta_title = isset($data['meta']) && isset($data['meta']['meta_title']) ? $data['meta']['meta_title'] : '';
                $update_seo->meta_description = isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '';
                $update_seo->meta_keyword = isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '';
                $update_seo->save();
            } else {
                Seo::create([
                    'object_id' => $post->id,
                    'type' => 'post',
                    'meta_title' => isset($data['meta']) && isset($data['meta']['meta_title']) ? $data['meta']['meta_title'] : '',
                    'meta_description' => isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '',
                    'meta_keyword' => isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '',
                ]);
            }
            $response = Post::with(['en','vi'])->find($post->id);
            return APIResponse::success($response);
        }
        return APIResponse::fail([],'Post not found');
    }
    public function destroy(Post $post){
        $post->delete();
        return APIResponse::success();
    }
}
