<?php

namespace Modules\User\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Modules\User\Contract\Backend\UserRepositoryInterface;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    use ApiResponser,AjaxPagination;

    public function getAll(){
        try {
            $data=[];
            $users =  User::paginate(10);
            if($users){
                foreach($users as $user){
                    $data[]=[
                        'id'            => $user->id,
                        'name'          =>  $user->name,
                        'email'         =>  $user->email,
                        'status'        =>  $user->getStatus($user->status),
                        'status_id'     =>  $user->status,
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Get User List!',null,['link'=>$this->ajaxPaginateLink($users)]);
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    public function store($param){
        try {

            $role = Role::whereNotIn('name',array(config('core.super-admin')))->where('name',$param['user_role'])->first();
            if(!$role)
            {
                throw new \ErrorException('System have only one supper admin');
            }
                DB::beginTransaction();
                $user = User::create([
                    'name'          =>  $param['user_name'],
                    'email'         =>  $param['user_email'],
                    'password'      =>  Hash::make($param['user_password']),
                    'status'        =>  $param['user_status'],
                ]);
                $user->assignRole($param['user_role']);
            if($user){
                DB::commit();
                return $this->successResponse(NULL, 'User Successfully add!');
            }
            DB::rollback();
            return $this->errorResponse();
        }
        catch (Exception $e) {
            DB::rollback();
            return $this->errorResponse();
        }
    }

    public function updateStatus($param){
        try {
            DB::beginTransaction();
            $user = User::find($param['id']);
            if(!$user){
                throw new \ErrorException('User not found');
            }
            if($user->hasRole(config('core.super-admin'))){
                throw new \ErrorException(config('core.super-admin') .' Naver change status');
            }
            $row = $user->update([
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
    public function getEditData($id){
        try {
            $user = User::find($id);
            if($user->hasRole(config('core.super-admin'))){
                throw new \ErrorException(config('core.super-admin') .' Naver change status');
            }
            if(!$user){
                throw new \ErrorException('ser not found');
            }
            $role = Role::whereNotIn('name',array( config('core.super-admin') ))->pluck('name');
            
            $data = [
                'user'=>[
                    'id'            => $user->id,
                    'name'          =>  $user->name,
                    'email'         =>  $user->email,
                    'status'        =>  $user->status,
                ],
                'roles'=>$role
            ];
            return $this->successResponseArray($data, 'Successfully Get Show List!');
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }

    } 
    public function update($param){
        try {
            DB::beginTransaction();
            $user = User::find($param['id']);
            if(!$user){
                throw new \ErrorException('User not found');
            }
            if($user->hasRole(config('core.super-admin'))){
                throw new \ErrorException(config('core.super-admin') .' Naver change status');
            }
            $data['name']= $param['user_name'];
            $data['email']= $param['user_email'];
            $data['status']= $param['status'];
            if(isset($param['password']) && $param['password'] != null && $param['password'] != '' ){
                $data['password']= Hash::make($param['user_password']);
            }
            $row = $user->update($data);
            $user->syncRoles($user->getRoleNames());
            $user->assignRole($param['user_role']);
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
            DB::beginTransaction();
            $user = User::find($id);
            if(!$user){
                throw new \ErrorException('User not found');
            }
            if($user->hasRole(config('core.super-admin'))){
                throw new \ErrorException(config('core.super-admin') .' Naver change status');
            }
            $row = $user->delete();
            if($row){
                DB::commit();
                return $this->successResponse(NULL, 'Successfully Status delete!');
            }
            DB::rollback();
            return $this->errorResponse();
        }
        catch (Exception $e) {
             DB::rollback();
            return $this->errorResponse();
        }
    }
}