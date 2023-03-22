<?php

namespace Modules\Core\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Contract\Backend\LoginInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Core\Entities\ApiLoginAuthenticationKey;
use Illuminate\Support\Facades\Hash;

class LoginRepository implements LoginInterface
{
    use ApiResponser;

    public function checkLogin($request){
        try {
            $user = User::where('email',$request->email)
                    ->first();
            if($user){
                if(Hash::check($request->password, $user->password)) {
                    $token = bin2hex(random_bytes(5));
                    $data=['token'=>$token];
                    date_default_timezone_set('Asia/Kolkata');
                    ApiLoginAuthenticationKey::create([
                        'authentican_key'=>$token,
                        'user_id'=>$user->id,
                        'driver'=>$request->from,
                        'login_time'=>date('Y-m-d H:i:s')]);   
                    return $this->successResponseArray($data, 'Successfully Login!');
                }
                return $this->errorResponse('Auth fail');
            }
            return $this->errorResponse('Auth fail');
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
}