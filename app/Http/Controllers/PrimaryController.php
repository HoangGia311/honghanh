<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alias;
use App\Page;

class PrimaryController extends Controller
{
    public $dataSendView = [
        "page_title" => "Hồng Hạnh"
    ];
    public function index($path = null){
    	if($path == null){
    		$page = Page::with(['component','vi','en'])->where('code','home_page')->first();
    		if(!$page){
    			return abort(404);
    		}
    		return $this->getHomePage($page);
    	}
    	$data_alias = Alias::where("alias",$path)->first();
    	if(!$data_alias){
    		return abort(404);
    	}
    	switch ($data_alias->type) {
    		case 'page':
    			return $this->getDataPage($data_alias->object_id);
    			break;
    		case 'product':
                break;
            case 'post':
                return $this->getDataPostDetail($data_alias->object_id);
                break;
            case 'cooking':
                break;
            case 'cooking':
                break;
    		default:
    			return abort(404);
    			break;
    	}
    }

    public function getDataPage($page_id = null){
    	$page = Page::with(['component','vi','en'])->find($page_id);
    	if(!$page){
    		return abort(404);
    	}
    	switch ($page->code) {
    		case 'home_page':
    			return $this->getHomePage($page);
    			break;
    		case 'about_us':
    			return $this->getAboutUsPage($page);
    			break;
    		case 'product':
    			return $this->getProductPage($page);
    			break;
    		case 'distribution':
    			return $this->getDistributionPage($page);
    			break;
    		case 'cooking':
    			return $this->getCookingPage($page);
    			break;
    		case 'post':
    			return $this->getPostPage($page);
    			break;
    		case 'contact':
    			return $this->getContactPage($page);
    			break;
    		default:
    			return abort(404);
    			break;
    	}
    }

    public function getHomePage($page){
        $this->dataSendView['page'] = "home";
        $this->dataSendView['page_title'] = "Hồng Hạnh";
    	return view("primary.home",$this->dataSendView );
    }
    public function getAboutUsPage($page){
        $this->dataSendView['page'] = "about_us";
    	return view("primary.about_us",$this->dataSendView);
    }
    public function getProductPage($page){
        $this->dataSendView['page'] = "product";
    	return view("primary.product",$this->dataSendView);
    }
    public function getDistributionPage($page){
        $this->dataSendView['page'] = "distribution";
    	return view("primary.distribution",$this->dataSendView);
    }
    public function getCookingPage($page){
        $this->dataSendView['page'] = "cooking";
    	return view("primary.cooking",$this->dataSendView);
    }
    public function getPostPage($page){
        $this->dataSendView['page'] = "post";
    	return view("primary.post",$this->dataSendView);
    }
    public function getContactPage($page){
        $this->dataSendView['page'] = "contact";
    	return view("primary.contact",$this->dataSendView);
    }

    public function getDataPostDetail($post_id = null){
        $post = Post::find($post_id);
        if(!$post){
            return abort(404);
        }
        return view("primary.post_detail");
    }
}
