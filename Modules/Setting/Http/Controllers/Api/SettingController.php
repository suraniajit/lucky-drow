<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Repository\Backend\SettingRepository;

class SettingController extends Controller
{
    protected $setting;
    function __construct(SettingRepository $setting){
        $this->setting = $setting;
    }
    public function update(Request $request){
        $param['mini_alter_balance'] = $request->mini_alter_balance;
        $param['tiket_price'] = $request->tiket_price;
        $param['setting_start_time'] = $request->setting_start_time;
        $param['setting_end_time'] = $request->setting_end_time;
        $param['auto_win_price'] = $request->auto_win_price;
        $param['win_price'] = $request->win_price;
        $param['stop_booking_before'] = $request->stop_booking_before;
        $param['win_quata'] = [];
        
        foreach($request->start_quata as $key=>$s_quata ){
            $param['win_quata'][]=[
                'start_quata'=>$s_quata,
                'end_quata'=>$request->end_quata[$key],
            ];
        }
        return $this->setting->save($param);
    }
    public function getSetting(){
        return $this->setting->getSettingData();
    }

}
