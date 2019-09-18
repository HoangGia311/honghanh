<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\EnProduct;
use App\ViProduct;
use App\Seo;
use App\Alias;
use App\Http\Responses\APIResponse;
use Validator;

class ProductController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword','');
        $limit = (int)$request->input('limit',config("constants.ITEM_PER_PAGE"));
        $query = Product::query();

        $products = $query->with(["vi","en"])->paginate($limit);
        return APIResponse::success($products);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'vi'=>'array|required',
            'vi.name' => 'required|max:191',
            'vi.description' => 'required:max:191',
            'vi.properties' => 'required|array',
            'en'=>'array|required',
            'en.name' => 'required|max:191',
            'en.description' =>'required',
            'en.properties' => 'required|array',
            'primary_image' => 'required'
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $product = Product::create($data);
        if($product){
            $data['vi']['product_id'] = $product->id;
            $data['en']['product_id'] = $product->id;
            ViProduct::create($data['vi']);
            EnProduct::create($data['en']);
            $alias = !empty($data['alias']) ? $data['alias'] : to_slug($data['vi']['name']);
            Alias::create([
                'alias' => $alias,
                'object_id' => $product->id,
                'type'  => 'product'
            ]);
            Seo::create([
                'object_id' => $product->id,
                'type' => 'product',
                'meta_title' => isset($data['meta']) && isset($data['meta']['meta_title'])  ? $data['meta']['meta_title'] : '',
                'meta_description' => isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '',
                'meta_keyword' => isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '',
            ]);
            $product = Product::with(['en','vi'])->find($product->id);
            return APIResponse::success($product);
        }
        return APIResponse::fail();
    }

    public function edit(Product $product){
        $product->load(['en','vi']);
        return APIResponse::success(compact('product'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'vi'=>'array|required',
            'vi.name' => 'required|max:191',
            'vi.description' => 'required:max:191',
            'vi.properties' => 'required|array',
            'en'=>'array|required',
            'en.name' => 'required|max:191',
            'en.description' =>'required',
            'en.properties' => 'required|array',
            'primary_image' => 'required'
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $product = Product::find($id);
        if($product){
            $product->update($data);
            $vi_product = ViProduct::where('product_id',$id)->first();
            if($vi_product){
                $vi_product->update($data['vi']);
            }else{
                $data['vi']['product_id'] = $id;
                ViProduct::create($data['vi']);
            }
            $en_product = EnProduct::where('product_id',$id)->first();
            if($en_product){
                $en_product->update($data['en']);
            }else{
                $data['en']['product_id'] = $id;
                EnProduct::create($data['en']);
            }

            $alias = !empty($data['alias']) ? $data['alias'] : to_slug($data['vi']['name']);
            $update_alias = Alias::where('type', 'product')->where("object_id", $product->id)->first();
            if ($update_alias) {
                $update_alias->alias = $alias;
                $update_alias->save();
            } else {
                Alias::create([
                    'alias' => $alias,
                    'object_id' => $product->id,
                    'type' => 'product'
                ]);
            }
            $update_seo = Seo::where('type', 'product')->where("object_id", $product->id)->first();
            if ($update_seo) {
                $update_seo->meta_title = isset($data['meta']) && isset($data['meta']['meta_title']) ? $data['meta']['meta_title'] : '';
                $update_seo->meta_description = isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '';
                $update_seo->meta_keyword = isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '';
                $update_seo->save();
            } else {
                Seo::create([
                    'object_id' => $product->id,
                    'type' => 'product',
                    'meta_title' => isset($data['meta']) && isset($data['meta']['meta_title']) ? $data['meta']['meta_title'] : '',
                    'meta_description' => isset($data['meta']) && isset($data['meta']['meta_description']) ? $data['meta']['meta_description'] : '',
                    'meta_keyword' => isset($data['meta']) && isset($data['meta']['meta_keyword']) ? $data['meta']['meta_keyword'] : '',
                ]);
            }
            $response = Product::with(['en','vi'])->find($product->id);
            return APIResponse::success($response);
        }
        return APIResponse::fail([],'Product not found');
    }
    public function destroy(Product $product){
        $product->delete();
        return APIResponse::success();
    }
}
