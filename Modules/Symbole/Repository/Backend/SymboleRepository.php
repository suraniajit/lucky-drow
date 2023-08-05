<?php

namespace Modules\Symbole\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Modules\Symbole\Contract\Backend\SymboleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use  Modules\Symbole\Entities\Symbole;
use Illuminate\Support\Facades\Storage;

use App\Models\User;


class SymboleRepository implements SymboleRepositoryInterface
{
    use ApiResponser,AjaxPagination;

   
    public function getAll(){
        try {
            $data=[];
            $symboles =  Symbole::paginate(10);
            if($symboles){
                foreach($symboles as $symbole){
                    $data[]=[
                        'id'            => $symbole->id,
                        'name'          =>  $symbole->name,
                        'status'        =>  $symbole->getStatusText($symbole->status),
                        'status_id'     =>  $symbole->status,
                        'file'          =>  asset($symbole->getSymbole($symbole->file)),
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Get User List!',null,['link'=>$this->ajaxPaginateLink($symboles)]);
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
            DB::beginTransaction();
            $symbole = Symbole::find($param['id']);
            if(!$symbole){
                throw new \ErrorException('Symbole not found');
            }
            $row = $symbole->update([
                'status'=>$param['status']]);
            if($row){
                DB::commit();
                return $this->successResponse(NULL, 'Successfully Status Updated!');
            }
            DB::rollback();
            return $this->errorResponse();
        }
        catch (Exception $e) {
            DB::rollback();
            return $this->errorResponse();
        }
    }

    public function store($param){
        try {
                if(!isOpenForSetting()){
                    return $this->errorResponseArray('server update time '.getSetting('setting_start_time'). ' to '.getSetting('setting_end_time'));
                }
                DB::beginTransaction();
                $symbole = new Symbole();
                $image_param = [
                    'file'=>$param['symbole'],
                    'path'=>$symbole->getSymbolePath(),
                    'name'=>time().'.'.$param['symbole']->extension(),
                ];
                $image_name = uploadImage($image_param); 
                $symbole->name = $param['symbole_name'];
                $symbole->file = $image_name;
                $symbole->status = $param['symbole_status'];
                $symbole->save();
            if($symbole){
                DB::commit();
                return $this->successResponse(NULL, 'Symbole Successfully add!');
            }
            DB::rollback();
            return $this->errorResponse();
        }
        catch (Exception $e) {
            DB::rollback();
            return $this->errorResponse();
        }
    }
       
    public function getEditData($id){
        try {
            $symbole = Symbole::find($id);
            if(!$symbole){
                throw new \ErrorException('symbole not found');
            }
            $data = [
                    'id'            =>  $symbole->id,
                    'name'          =>  $symbole->name,
                    'file'          =>  asset($symbole->getSymbole($symbole->file)),
                    'status'        =>  $symbole->getStatusText($symbole->status),
                    'status_id'     =>  $symbole->status,
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
            DB::beginTransaction();
            $symbole = Symbole::find($param['id']);
            if(!$symbole){
                throw new \ErrorException('Symbole not found');
            }
            $data['name']= $param['symbole_name'];
            if(isset($param['edit_symbole_file']) && $param['edit_symbole_file'] !='' ){
                $image_param = [
                    'file'=>$param['edit_symbole_file'],
                    'path'=>$symbole->getSymbolePath(),
                    'name'=>pathinfo($param['edit_symbole_file']->getClientOriginalName(),PATHINFO_FILENAME).date('_d_M_Y_h_i_s').'.'.$param['edit_symbole_file']->extension(),
                ];
                $image_name = uploadImage($image_param); 
                if(file_exists(public_path($symbole->getSymbole($symbole->file)))){
                    unlink(public_path($symbole->getSymbole($symbole->file)));
                }
                $data['file']= $image_name;;
            }
            $data['status']= $param['status'];
            $row = $symbole->update($data);
             if($row){
                DB::commit();
                return $this->successResponse(NULL, 'Successfully Status Updated!');
            }
            DB::rollback();
            return $this->errorResponse();
        }
        catch (Exception $e) {
            DB::rollback();
            return $this->errorResponse();
        }    
    }


    public function distroy($id){
        try {
            if(!isOpenForSetting()){
                return $this->errorResponseArray('server update time '.getSetting('setting_start_time'). ' to '.getSetting('setting_end_time'));
            }
            DB::beginTransaction();
            $symbole = Symbole::find($id);
            if(!$symbole){
                throw new \ErrorException('Symbole not found');
            }
            
            $row = $symbole->delete();
            if($row){
                DB::commit();
                return $this->successResponse(NULL, 'Successfully Symbole delete!');
            }
            DB::rollback();
            return $this->errorResponse();
        }
        catch (Exception $e) {
             DB::rollback();
            return $this->errorResponse();
        }
    }
    public function getBookingSymboleList(){
        try {
            $data=[];
            $symboles =  Symbole::where('status',Symbole::ENABLE);
            $symboles = $symboles->orderBy('id','DESC')->get();
            $price = getSetting('tiket_price');
            if($symboles){
                foreach($symboles as $symbole){
                    $data[]=[
                        'id'            => $symbole->id,
                        'name'          => $symbole->name,
                        'file'          => asset($symbole->getSymbole($symbole->file)),
                        'price'         => $price,
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Get Symbole List!');
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
}