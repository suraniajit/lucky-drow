<?php

namespace Modules\Role\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Role\Http\Requests\StorePermissionRequest; 
use Modules\Role\Repository\Backend\PermissionRepository;    

class PermissonController extends Controller
{
    public function index()
    {
        $PermissionRepository = new PermissionRepository();
        return $PermissionRepository->getAll();
    }

    public function store(StorePermissionRequest $request)
    {
        $param = $request->all();
        $permissionRepository = new PermissionRepository();
        return $permissionRepository->store($param);
    }
    
    public function show($id)
    {
        return view('role::show');
    }

    public function edit($id)
    {
        return view('role::edit');
    }
    public function update(Request $request, $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $permissionRepository = new PermissionRepository();
        return $permissionRepository->distroy($id);
    }
}
