<?php

use Modules\Core\Http\Help\Module;
use Illuminate\Support\Facades\Session;
// use Modules\Contactus\Entities\ContactUs;


if (!function_exists('getModuleList')) {
    function getModuleList()
    {
       $module = new Module();
        return $module->getModules();
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
