<?php

namespace Modules\Core\Http\Help;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
// use Modules\Banner\Http\Controllers
use Illuminate\Support\Facades\Session;
class Module extends Controller
{
    public function addModule($String){
        $ModulesArray = [];   
        if(Session::exists('Modules')){
            $ModulesArray = Session::get('Modules');    
        }
        $ModulesArray[] = $String;
        Session::put('Modules', $ModulesArray);
        return true;
    }
    public function getModules(){
        return Session::get('Modules');
    }
}
