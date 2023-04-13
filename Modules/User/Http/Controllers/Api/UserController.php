<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repository\Backend\UserRepository;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $userRepository = new UserRepository();
        $response =  $userRepository->getAll();
        return $response;
    }

    public function store(Request $request)
    {
        $param = $request->all();
        $userRepository = new UserRepository();
        $response =  $userRepository->store($param);
        return $response;
    }

    public function statusUpdate(Request $request){
        
        $param = $request->all();
        $userRepository = new UserRepository();
        $response =  $userRepository->updateStatus($param);
       return $response;
    }

    
    public function show($id)
    {
        
    }
    public function edit($id)
    {
        $userRepository = new UserRepository();
        $response =  $userRepository->getEditData($id);
       return $response;
    }
    
    public function update(Request $request)
    { 
        $param = $request->all();
        $userRepository = new UserRepository();
        $response =  $userRepository->update($param);
        return $response;
    }
    
    public function destroy($id)
    {
        $userRepository = new UserRepository();
        $response =  $userRepository->distroy($id);
        return $response;
    }

}
