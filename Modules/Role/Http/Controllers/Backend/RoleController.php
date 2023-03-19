<?php

namespace Modules\Role\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    { 
        return view('role::role.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function getPeramissionManage($role_name)
    {
        try {
            $role = Role::where('name',$role_name)->first();
            if(!$role){
                throw new \ErrorException('role not found');
                }
            if($role_name == config('core.super-admin')){
                throw new \ErrorException("you can't able to change permission of super-admin");
            }
            return view('role::role.role_permission')->with(['role_name'=>$role_name]);
        }
        catch (\ErrorException $e) {
            // return view('role::role.index');
            return redirect(route('admin.role.index'))->with('message', 'error|'.$e->getMessage());
            
            // Redirect::back()->with('message', 'message|Record updated.');
            
            // Redirect::to('/')->with('message', 'success|Record updated.');
        }
    }
    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('role::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('role::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
