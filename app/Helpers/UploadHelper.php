<?php

namespace App\Helpers;
class UploadHelper
{
    
    public static function uploadImage($file){
        $imageName = time().uniqid().'.'.$file->getClientOriginalExtension();
        $path = public_path()."/attached-files/".Date("Y-m-d");
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        $upload = $file->move($path, $imageName);
        $url_path = 'attached-files/'.Date("Y-m-d").'/'.$imageName;
        return url($url_path);
    }
}