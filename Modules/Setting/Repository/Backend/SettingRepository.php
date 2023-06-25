<?php

namespace Modules\Setting\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Modules\Setting\Contract\Backend\SettingRepositoryInterface;
use App\Models\User;
use Modules\Setting\Entities\Setting;

class SettingRepository implements SettingRepositoryInterface
{
    use ApiResponser,AjaxPagination;

    public function save($param){
        try{
            foreach($param as $key=>$value){
                $setting = Setting::where('key',$key)->first();
                if(!$setting){
                    $setting = new Setting();
                }
                $setting->key = $key;
                $setting->value = json_encode($value);
                $setting->save();
            }
            return $this->successResponseArray(null, 'Successfully SettingSave!');
        }catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    public function getSettingData(){
        try{
            $data =[
                'mini_alter_balance'=>getSetting('mini_alter_balance'),
                'tiket_price'=>getSetting('tiket_price'),
                'setting_start_time'=>getSetting('setting_start_time'),
                'setting_end_time'=>getSetting('setting_end_time'),
                'auto_win_price'=>getSetting('auto_win_price'),
                'win_price'=>getSetting('win_price'),
                'win_quata'=>getSetting('win_quata'),
                'stop_booking_before'=>getSetting('stop_booking_before')
            ];
            return $this->successResponseArray($data, 'Successfully Get Setting Data!');
        }catch (Exception $e) {
            return $this->errorResponse();
        }
    }
}