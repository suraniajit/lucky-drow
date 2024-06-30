<?php

namespace Modules\Show\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Modules\Show\Contract\Backend\ShowRepositoryInterface;
use Modules\Show\Entities\Show;

class ShowRepository implements ShowRepositoryInterface
{
    use ApiResponser,AjaxPagination;

    public function getAll(){
        try {
            $data=[];
            $shows =  Show::paginate(10);
            if($shows){
                foreach($shows as $show){
                    $data[]=[
                        'id'            => $show->id,
                        'name'          =>  $show->show_name,
                        'time'          =>  date('h:i A',strtotime($show->show_time)),
                        'start_date'    =>  $show->start_date,
                        'end_date'      =>  $show->end_date,
                        'status'        =>  $show->getStatus($show->status),
                        'status_id'     =>  $show->status,
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Get Show List!',null,['link'=>$this->ajaxPaginateLink($shows)]);
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function store($param){
        try {
            if(!isOpenForSetting()){
                return $this->errorResponseArray('server update time '.getSetting('setting_start_time'). ' to '.getSetting('setting_end_time'));
            }
            $show = Show::create([
                'show_name'     =>  $param['show_name'],
                'show_time'     =>  $param['show_time'],
                'start_date'    =>  $param['start_date'],
                'end_date'      =>  $param['end_date'],
                'show_day'      =>  json_encode(array_values($param['day'])),
                'status'        =>  (isset($param['status']) && $param['status'] == Show::ENABLE)?$param['status']:Show::DISABLE,
            ]);
            if($show){
                return $this->successResponse(NULL, 'Show Successfully add!');
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    public function updateStatus($param){
        try {
            if(!isOpenForSetting()){
                return $this->errorResponseArray('server update time '.getSetting('setting_start_time'). ' to '.getSetting('setting_end_time'));
            }
            $show = Show::find($param['id']);
            if(!$show){
                throw new \ErrorException('Show not found');
            }
            $row = $show->update([
                'status'=>$param['status']]);
            if($show){
                return $this->successResponse(NULL, 'Successfully Status Updated!');
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    public function distroy($id){
        try {
            if(!isOpenForSetting()){
                return $this->errorResponseArray('server update time '.getSetting('setting_start_time'). ' to '.getSetting('setting_end_time'));
            }
            $show = Show::find($id);
            if(!$show){
                throw new \ErrorException('Show not found');
            }
            $row = $show->delete();
            if($row){
                return $this->successResponse(NULL, 'Successfully Status delete!');
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    public function getEditData($id){
        try {
            
            $show = Show::find($id);
            if(!$show){
                throw new \ErrorException('Show not found');
            }
            $data = [
                'id'            =>  $show->id,
                'show_name'     =>  $show->show_name,
                'show_time'     =>  $show->show_time,
                'start_date'    =>  $show->start_date,
                'end_date'      =>  $show->end_date,
                'show_day'      =>  $show->show_day,
                'status'        =>  $show->status,
            ];
            return $this->successResponseArray($data, 'Successfully Get Show List!');
         
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }

    }   
    public function update($param){
        try {
            if(!isOpenForSetting()){
                return $this->errorResponseArray('server update time '.getSetting('setting_start_time'). ' to '.getSetting('setting_end_time'));
            }
            $show = Show::find($param['id']);
            if(!$show){
                throw new \ErrorException('Show not found');
            }
            $row = $show->update([
                'show_name'     =>  $param['show_name'],
                'show_time'     =>  $param['show_time'],
                'start_date'    =>  $param['start_date'],
                'end_date'      =>  $param['end_date'],
                'show_day'      =>  json_encode(array_values($param['day'])),
                'status'        =>  (isset($param['status']) && $param['status'] == Show::ENABLE)?$param['status']:Show::DISABLE,
            ]);
            if($show){
                return $this->successResponse(NULL, 'Successfully Status Updated!');
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }    
    }
    public function getBookingShowList(){
        try {
            $data=[];
            $shows =  Show::where('show_time','>=',date('H:i:s',strtotime('+'.getSetting('stop_booking_before').'minute')))
                    ->where('status',Show::ENABLE)
                    ->where('start_date','<=',date('Y-m-d'))
                    ->where('end_date','>=',date('Y-m-d'))
                    ->whereRaw('json_contains(show_day, \'["'.date('N').'"]\')')
                    ->orderBy('show_time')
                    ->get();
           
            if($shows){
                foreach($shows as $show){
                    $data[]=[
                        'id'            => $show->id,
                        'time'          =>  date('h:i A',strtotime($show->show_time)),
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Get Show List!');
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    
}