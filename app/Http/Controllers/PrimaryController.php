<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alias;
use App\Page;

class PrimaryController extends Controller
{
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
    	return view("primary.home");
    }
    public function getAboutUsPage($page){
    	return view("primary.about_us");
    }
    public function getProductPage($page){
    	return view("primary.product");
    }
    public function getDistributionPage($page){
    	return view("primary.distribution");
    }
    public function getCookingPage($page){
    	return view("primary.cooking");
    }
    public function getPostPage($page){
    	return view("primary.post");
    }
    public function getContactPage($page){
    	return view("primary.contact");
    }

    public function getDataPostDetail($post_id = null){
        $post = Post::find($post_id);
        if(!$post){
            return abort(404);
        }
        return view("primary.post_detail");
    }
}
