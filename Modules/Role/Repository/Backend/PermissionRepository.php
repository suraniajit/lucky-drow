<?php

namespace Modules\Role\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Spatie\Permission\Models\Permission;
use Modules\Role\Contract\Backend\PermissionInterface;
use App\Models\User;
use Spatie\Permission\Models\Role;

class PermissionRepository implements PermissionInterface
{
    use ApiResponser,AjaxPagination;

    public function getAll(){
        try {
            $data=[];
            $permissions =  Permission::paginate(10);
            if($permissions){
                foreach($permissions as $key=> $permission){
                    $data[]=[
                        'id'=>$permission->id,
                        'name'=>$permission->name,
                        // 'user_count'=>count(User::role($role)->get())
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Get Role List!',null,['link'=>$this->ajaxPaginateLink($permissions)]);
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
            $permission = Permission::create(['name' =>$param['name']]);
            if($permission){
                $role = Role::where('name',config('core.super-admin'))->first();
                $role->givePermissionTo($param['name']);
                return $this->successResponse(NULL, 'Permission Successfully add!');
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
            $permissionsdata = Permission::where('id',$id)->first();
            if($permissionsdata){
                Permission::where('id',$id)->delete();
                return $this->successResponseArray(NULL, 'Successfully '. $permissionsdata->name .' delete!');
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
}