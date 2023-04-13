<?php

namespace Modules\Core\Http\Controllers\Backend;

use Modules\Core\Entities\ApiLoginAuthenticationKey;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class AuthController extends Controller
{
    public function login(){
        if (Auth::check()) {
            return redirect(route('admin.home.index'));
        }
        return view('themes::backend.auth.login');
    }

    public function loginCheck(Request $request){
        if (Auth::check()) {
            return redirect(route('admin.home.index'));
        }
        $credentials = $request->only('email', 'password');
        $credentials['status'] = User::ACTIVE;
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('admin.home.index'));
        }
        return redirect(route('admin.backend.login')); 
    }
    public function logout(Request $request){
        if (Auth::check()) {
            $db_auth_row = ApiLoginAuthenticationKey::where('authentican_key',$request->_auth_key)->first();
            if($db_auth_row){
                date_default_timezone_set('Asia/Kolkata');
                $db_auth_row->update([
                    'logout_time'=>date('Y-m-d H:i:s'),
                ]);
            }
            Auth::logout();
        }
        return redirect(route('admin.backend.login'));
    }
}
