<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Repository\Backend\LoginRepository;

class AuthController extends Controller
{
    public function checkLogin(LoginRequest $request){
       $login = new  LoginRepository();
       return $login->checkLogin($request);
    }
}
