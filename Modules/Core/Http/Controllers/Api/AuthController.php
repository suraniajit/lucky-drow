<?php

namespace Modules\Core\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Core\Http\Requests\LoginRequest;
use Modules\Core\Repository\Backend\LoginRepository;

class AuthController extends Controller
{
    public function checkLogin(LoginRequest $request){
       $login = new  LoginRepository();
       return $login->checkLogin($request);
    }
}
