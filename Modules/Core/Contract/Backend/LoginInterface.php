<?php 
namespace Modules\Core\Contract\Backend;
interface LoginInterface
{  
    public function checkLogin($request);
}