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
    	return "home_page";
    }
    public function getAboutUsPage($page){
    	return "about_us";
    }
    public function getProductPage($page){
    	return "product";
    }
    public function getDistributionPage($page){
    	return "distribution";
    }
    public function getCookingPage($page){
    	return "cooking";
    }
    public function getPostPage($page){
    	return "post";
    }
    public function getContactPage($page){
    	return "contact";
    }
}
