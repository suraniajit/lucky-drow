<?php

use Modules\Core\Http\Help\Module;
use Illuminate\Support\Facades\Session;
use Modules\Setting\Entities\Setting;
use Modules\Balance\Entities\Balance;
use Modules\Booking\Entities\Booking;
use Modules\Booking\Entities\BookingDetail;
use Illuminate\Support\Facades\DB;
use Modules\Symbole\Entities\Symbole;
use Modules\Show\Entities\Show;
use Modules\Result\Entities\WinningShow;

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
    function uploadImage($params){   
        $file = $params['file'];
        $path_to_store = $params['path'];
        $filenametostore = $params['name'];
        $file->move(public_path($path_to_store), $filenametostore);
        return $filenametostore; 
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
        return strtoupper(date('Ymd').uniqid());
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

if (!function_exists('getSymboleWiseBooking')) {
    function getSymboleWiseBooking($date,$time){
        $datas = BookingDetail::
            join('bookings','booking_details.booking_id','bookings.id')
            ->join('symboles','symboles.id','=','booking_details.symbol_id')
            ->join('shows','shows.id','=','bookings.show_id')
            ->select([
                DB::raw('SUM(book) as total_booking'),
                'symbol_id',
             ])
            ->where('shows.show_time',$time)
            ->where('bookings.booking_for',$date)
            ->groupBy('symbol_id')
            ->get();
        $symbole_wise_booking = [];
        foreach(Symbole::get() as $symbole){
            $symbole_wise_booking[$symbole->id] = 0;
            foreach($datas as $data){
                if($data->symbol_id == $symbole->id){
                    $symbole_wise_booking[$symbole->id] = $data->total_booking;
                }      
            }
        }
        return $symbole_wise_booking;
    }
}
if (!function_exists('getLuckyDrowWinningSymbole')) {
    function getLuckyDrowWinningSymbole($date,$time){
        $wining_amount_symobole_wise = [];
        $total_collection = 0;
        $tiket_price = getSetting('tiket_price');
        $showWiseBooking = getSymboleWiseBooking($date,$time);
        $per_tiket_winning = getWinningAmount();
        foreach($showWiseBooking as $key=>$booking){
            $wining_amount_symobole_wise[$key] = $booking * $per_tiket_winning  ;
            $total_collection += $booking * $tiket_price;
        } 
        $setting = getSetting('win_quata');
        $winner_symbole = null;
        
        /*
        echo "collection total=>".$total_collection;
        echo "<br>";
        echo "winning price => ". $per_tiket_winning;
        echo "<pre>";
        echo "wing cota";

        print_r($showWiseBooking);
        echo "<pre>";
        print_r($wining_amount_symobole_wise);
        die;  
        */
        
        foreach($setting as $class){
            if($winner_symbole != null)
                break;
            if($total_collection <= 0)
                break;
            foreach($wining_amount_symobole_wise as $symbole_id=>$booking_win_amount){
                if($winner_symbole != null)
                    break;
                $win_per = ( $booking_win_amount * 100) / $total_collection ;
                if(($class->start_quata < $win_per) && ($class->end_quata > $win_per)  ){
                    $winner_symbole = $symbole_id;
                }
            }
        }
        if($winner_symbole == null){
            asort($showWiseBooking);
            $showWiseBooking = array_keys($showWiseBooking);
            $winner_symbole = $showWiseBooking[0];
        }      
        return [
            'winner_symbole'        =>  $winner_symbole,
            'total_collection'      =>  $total_collection,
            'total_winning_amount'  =>  $wining_amount_symobole_wise[$winner_symbole],
            'symbole_wise_booking'  =>  $showWiseBooking,
        ];
    }
}
if (!function_exists('getWinningAmount')) {
    function getWinningAmount(){
        if(getSetting('auto_win_price')){
            return (Symbole::count() * $tiket_price) ;
        }else{
            return getSetting('win_price') *  getSetting('tiket_price') ;
        }
    }
}
if(!function_exists('getNextDrowshowTime')){  
    function getNextDrowshowTime(){
        $current_date_string = date('Y-m-d');
        $current_time_string = date('H:i:00');
        $show_drow_complete = WinningShow::where('drow_date',$current_date_string)
                    ->pluck('show_id')
                    ->toArray();
        $shows =  Show::where('show_time','<=',date('H:i:s'))
                    ->where('status',Show::ENABLE)
                    ->where('start_date','<=',date('Y-m-d'))
                    ->where('end_date','>=',date('Y-m-d'))
                    ->whereNotIn('shows.id',$show_drow_complete)
                    ->whereRaw('json_contains(show_day, \'["'.date('N').'"]\')')
                    ->orderBy('show_time')
                    ->first();
        if($shows){
            return [
                'result'    =>  true,
                'drow_date'      =>  date('Y-m-d'),
                'time'      =>  $shows->show_time,
                'show_id'   =>  $shows->id,
            ];
        }
        return [
            'result'=>false,
        ];
    }

}