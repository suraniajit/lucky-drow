<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Entities\ApiLoginAuthenticationKey;


class APIAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next , ...$guards)
    {
        try {
            $APIAuthKey = $request->header('APIAuthKey');

            $user_id = ApiLoginAuthenticationKey::where('authentican_key',$APIAuthKey)->whereNull('logout_time')->first();
            if(!$user_id){
                echo 'APIAuthKey invalid or expired please check';
                exit;
            }
            $user = User::find($user_id->user_id);
            if(!$user){
                echo 'APIAuthKey invalid ';
                exit;
            }
            Auth::login($user);
            if(!$user->can($guards[0])){
                echo 'User Not Authorize For This Action ';
                exit;
            }
            return $next($request);
          } catch (\Exception $e) {          
              return $e->getMessage();
          }
       
        
    }
}
