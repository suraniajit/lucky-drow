<?php

namespace Modules\Role\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Spatie\Permission\Models\Permission;
use Modules\Role\Contract\Backend\RolePermissionInterface;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePermissionRepository implements RolePermissionInterface
{
    use ApiResponser,AjaxPagination;

    public function getAll($rolename){
        try {
            $data=[];
            $role = Role::where('name',$rolename)->first();
            if(!$role){
                throw new \ErrorException('role not found');
             }
            if($rolename ==config('core.super-admin')){
                throw new \ErrorException("you can't able to change permission of super-admin");
            }

            // if(Role::where('name',$rolename))
            $permissions =  Permission::paginate(10);
            if($permissions){
                foreach($permissions as  $permission){
                    $data[]=[
                        'id'=>$permission->id,
                        'name'=>$permission->name,
                        'status'=> $role->hasPermissionTo($permission->name),
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
    
    public function changePermissionStatus($roleName,$permission,$flag){
        try {
                if(!isOpenForSetting()){
                    return $this->errorResponseArray('server update time '.getSetting('setting_start_time'). ' to '.getSetting('setting_end_time'));
                }
                $role = Role::where('name',$roleName)->first();
                if(!$role){
                    throw new \ErrorException('role not found');
                }
                if($roleName ==config('core.super-admin')){
                    throw new \ErrorException("you can't able to change permission of super-admin");
                }
                if($flag == true){
                    if($role->givePermissionTo($permission))
                        return $this->successResponse(NULL, 'Successfully '.$roleName.' '.$permission.' permission assign !');
                    else
                        return $this->errorResponse();
                }else{
                    if($role->revokePermissionTo($permission))
                        return $this->successResponse(NULL, 'Successfully '.$roleName.' '.$permission.' permission remove !');
                    else
                        return $this->errorResponse();
                }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    
    

}