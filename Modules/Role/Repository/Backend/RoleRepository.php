<?php

namespace Modules\Role\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Spatie\Permission\Models\Role;
use Modules\Role\Contract\Backend\RoleInterface;
use App\Models\User;

class RoleRepository implements RoleInterface
{
    use ApiResponser,AjaxPagination;

    public function getAll(){
        try {
            $data=[];
            $roles =  Role::paginate(10);
            if($roles){
                foreach($roles as $role){
                    $data[]=[
                        'name'=>$role->name,
                        'user_count'=>count(User::role($role->name)->get())
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Get Role List!',null,['link'=>$this->ajaxPaginateLink($roles)]);
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function store($param){
        try {
            $role = Role::create(['name' =>$param['name']]);
            if($role){
                return $this->successResponse(NULL, 'Role Successfully add!');
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
}