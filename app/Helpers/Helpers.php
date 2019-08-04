<?php
function export($data, $captions, $type='xls', $filename, $sheet_name='sheet1')
{
    if (!in_array($type, ['xls', 'csv'])) {
        $type = 'xls';
    }
    
    $fn = $filename.'-'.date('Y-m-d_H-i-s');
    
    \Excel::create($fn, function ($excel) use ($data, $captions,$sheet_name) {
        $excel->sheet($sheet_name, function ($sheet) use ($data, $captions) {
            $sheet->fromArray($data, null, 'A1', false, false);
            $sheet->prependRow(1, $captions);
            $sheet->freezeFirstRow();
        });

    })->export($type);
}

function isNoneAuthorizeAction($actionName)
{
    $noneAuthorizeActions = config("constants.NONE_AUTHORIZE_ACTIONS");
    $actionArray = explode('.', $actionName);
    $key = $actionArray[0];
    if (count($actionArray) > 1)
        $actionAllItem = $key.".*";
    else
        $actionAllItem = null;
    return in_array($actionName, $noneAuthorizeActions) || in_array($actionAllItem, $noneAuthorizeActions);
    
}
function to_slug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}