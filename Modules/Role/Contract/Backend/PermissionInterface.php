<?php 
namespace Modules\Role\Contract\Backend;
interface PermissionInterface
{  
    public function getAll();
    public function store(array $parms);
}