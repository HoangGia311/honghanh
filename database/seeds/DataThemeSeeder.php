<?php

use Illuminate\Database\Seeder;
use App\Page;
use App\EnPage;
use App\ViPage;
use App\Component;
use App\Alias;

class DataThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Page::truncate();
    	ViPage::truncate();
    	EnPage::truncate();
        Alias::where("object_id",'page')->delete();
        $pages = [
        	[
        		"vi" => [
        			"name" => "Toàn trang"
        		],
        		"en" => [
        			"name" => "Full Page"
        		],
        		"is_show" => false,
        		"code" => "full_page"
        	],
        	[
        		"vi" => [
        			"name" => "Trang Chủ"
        		],
        		"en" => [
        			"name" => "Home"
        		],
        		"is_show" => true,
        		"code" => "home_page"
        	],
        	[
        		"vi" => [
        			"name" => "Về Chúng Tôi"
        		],
        		"en" => [
        			"name" => "About Us"
        		],
        		"is_show" => true,
        		"code" => "about_us"
        	],
        	[
        		"vi" => [
        			"name" => "Sản phẩm"
        		],
        		"en" => [
        			"name" => "Products"
        		],
        		"is_show" => true,
        		"code" => "product"
        	],
        	[
        		"vi" => [
        			"name" => "Phân phối"
        		],
        		"en" => [
        			"name" => "Distribution"
        		],
        		"is_show" => true,
        		"code" => "distribution"
        	],
        	[
        		"vi" => [
        			"name" => "Món ngon"
        		],
        		"en" => [
        			"name" => "Cooking"
        		],
        		"is_show" => true,
        		"code" => "cooking"
        	],
        	[
        		"vi" => [
        			"name" => "Tin tức"
        		],
        		"en" => [
        			"name" => "Posts"
        		],
        		"is_show" => true,
        		"code" => "post"
        	],
        	[
        		"vi" => [
        			"name" => "Liên hệ"
        		],
        		"en" => [
        			"name" => "Contact"
        		],
        		"is_show" => true,
        		"code" => "contact"
        	],
        	[
        		"vi" => [
        			"name" => "Chi tiết bài viết"
        		],
        		"en" => [
        			"name" => "Post details"
        		],
        		"is_show" => false,
        		"code" => "post_detail"
        	],
        ];
        foreach($pages as $page){
        	$result = Page::create([
        	    "is_show" => $page['is_show'],
                "code" => $page['code']
            ]);
        	$page['vi']['page_id'] = $result->id;
        	$page['en']['page_id'] = $result->id;
        	ViPage::create($page['vi']);
        	EnPage::create($page['en']);
            if($result->is_show){
                $alias = to_slug($page['vi']['name']);
                Alias::create([
                    'alias' => $alias,
                    'object_id' => $result->id,
                    'type' => 'page'
                ]);
            }
            
        }
    }
}
