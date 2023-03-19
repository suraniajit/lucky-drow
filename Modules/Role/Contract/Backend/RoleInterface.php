<?php 
namespace Modules\Role\Contract\Backend;
interface RoleInterface
{  
    public function getAll();
    public function store(array $parms);
}