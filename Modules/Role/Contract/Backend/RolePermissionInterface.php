<?php 
namespace Modules\Role\Contract\Backend;
interface RolePermissionInterface
{  
    public function getAll($rolename);
    public function changePermissionStatus($roleName,$permission,$flag);
}