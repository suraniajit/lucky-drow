<?php

namespace Modules\Role\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Role\Http\Requests\StorePermissionRequest; 
use Modules\Role\Repository\Backend\RolePermissionRepository;    

class RolePermissionController extends Controller
{
    // private $RoleRepository;
    // public function __construct(RoleInterface $RoleRepository)
    // {
    //     $this->RoleRepository = $RoleRepository;
    // }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($roleName)
    {
        $RolePermissionRepository = new RolePermissionRepository();
        return $RolePermissionRepository->getAll($roleName);
    }

    /**
     * changePermissionStatus a inwalk during permission change.
     * @param roleName for which role
     * @param permission for which permission
     * @param flag for status
     * @return Renderable
     */
    public function changePermissionStatus($roleName,$permission,$flag){
        $RolePermissionRepository = new RolePermissionRepository();
        return $RolePermissionRepository->changePermissionStatus($roleName,$permission,$flag);
    }
    
}
