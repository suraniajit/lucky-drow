<?php

use Modules\Core\Http\Help\Module;
use Illuminate\Support\Facades\Session;
use Modules\Setting\Entities\Setting;
use Modules\Balance\Entities\Balance;

if (!function_exists('getModuleList')) {
    function getModuleList()
    {
       $module = new Module();
        return $module->getModules();
    }
}
if (!function_exists('getSetting')) {
    function getSetting($key)
    {
       $setting_data = Setting::pluck('value','key')->toArray();
       return (isset($setting_data[$key]))?json_decode($setting_data[$key]):null;
    }
}

if (!function_exists('getMenuList')) {
    function getMenuList()
    {
        $ModuleLists = getModuleList();
        $menulist =[];
        foreach($ModuleLists as $ModuleList)
        {
            $menuArray=[];
            $filePath = str_replace('\\', '/' ,base_path().'/Modules/'.$ModuleList.'/Slider/menu.php');
            if(file_exists($filePath))
            {
                include $filePath;
                $menulist[] = $menuArray;
            }
        }
        return $menulist;
    }
}

if (!function_exists('createThumbnail')) {
    function createThumbnail($path,$image_name, $width, $height,$fixed=false)
    {
        $destiation_image_path = $path."/thumbnail/".$image_name;
        $orignalImageFullPath = $path.'/'.$image_name;
        if(!file_exists(public_path($destiation_image_path)))
        {
            if($fixed==true){
                $img = Image::make($orignalImageFullPath)->resize($width, $height);
            }else{
                $img = Image::make($orignalImageFullPath)->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $img->save($destiation_image_path);
            return $destiation_image_path;
        }else{
            return $destiation_image_path;
        }

        
    }
}
if (!function_exists('uploadImage')) {
    function uploadImage($params)
    {   
        $file = $params['file'];
        $path_to_store = $params['path'];
        $filenametostore = $params['name'];
        $file->move(public_path($path_to_store), $filenametostore);
        return $filenametostore; 
    }
}

if (!function_exists('displayAlert')) {
    function displayAlert()
    {
        if (Session::has('message'))
        {
           list($type, $message) = explode('|', Session::get('message'));
            $type = $type == 'error' ?: 'danger';
            $type = $type == 'message' ?: 'info';
            $string ='<div class="alert alert-danger alert-dismissible">';
            $string .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            $string .= '<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
            $string .= $message;
            $string .="</div>";
            echo $string;
        }
    }
}
if (!function_exists('getThemeString')) {
    function getThemeString()
    {   
        return [];
    }
}

if (!function_exists('getTransactionNo')) {
    function getTransactionNo()
    {   
        return uniqid();
    }
}
if (!function_exists('getBookingNo')) {
    function getBookingNo()
    {   
        return strtoupper(date('Ymd').uniqid());
    }
}

if (!function_exists('getDateTime')) {
    function getDateTime($datetime)
    {   
        return date('d M Y h:i:s',strtotime($datetime));
    }
}
if (!function_exists('getDate')) {
    function getDate($datetime)
    {   
        return date('d M Y',strtotime($datetime));
    }
}
if (!function_exists('getTime')) {
    function getTime($datetime)
    {   
        return date('h:i:s',strtotime($datetime));
    }
}


    
if (!function_exists('getOTP')) {
    function getOTP()
    {   
        return rand(100000, 999999);
    }
}
if (!function_exists('getDays')) {
    function getDays()
    {   
        return[
            1=>'Sunday',
            2=>'Monday',
            3=>'Tuesday',
            4=>'Wednesday',
            5=>'Thursday',
            6=>'Friday',
            7=>'Saturday'
        ];
    }
}

if (!function_exists('isOpenForSetting')) {
    function isOpenForSetting()
    {   
        if( (date('Hi',strtotime(getSetting('setting_start_time').':00')) <= date('Hi')) && (date('Hi',strtotime(getSetting('setting_end_time').':00')) >= date('Hi')) ){
            return true;
        }
        return false;
    }
}

if (!function_exists('checkEnoughBalance')) {
    function checkEnoughBalance($order_abount)
    {   
        
        if(Auth::user()->hasRole(config('core.super-admin'))){
            return true;
        }
        $user_acount = Balance::where('user_id',auth()->user()->id)->first();
        if($user_acount){
            if($user_acount->balance >= $order_abount){
                return true;
            }
            return false;
        }
        return false;
    }
}



