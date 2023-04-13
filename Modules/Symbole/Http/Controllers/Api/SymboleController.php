<?php

namespace Modules\Symbole\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repository\Backend\UserRepository;
use Modules\Symbole\Repository\Backend\SymboleRepository;

class SymboleController extends Controller
{
    public function index(Request $request)
    {
        $symbole_repository = new SymboleRepository();
        $response =  $symbole_repository->getAll();
        return $response;
    }
    
    public function edit($id)
    {
        $symbole_repository = new SymboleRepository();
        $response =  $symbole_repository->getEditData($id);
       return $response;
    }

    public function store(Request $request)
    {
        $param = $request->all();
        $symbole_repository = new SymboleRepository();
        $response =  $symbole_repository->store($param);
        return $response;
    }

    public function updateStatus(Request $request){
        $param = $request->all();
        $symbole_repository = new SymboleRepository();
        $response =  $symbole_repository->updateStatus($param);
        return $response;
    }

    public function update(Request $request)
    { 
        $param = $request->all();
        $symbole_repository = new SymboleRepository();
        $response =  $symbole_repository->update($param);
        return $response;
    }
    
    public function destroy($id)
    {
        $symbole_repository = new symbole_repository();
        $response =  $symbole_repository->distroy($id);
        return $response;
    }
}
