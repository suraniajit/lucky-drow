<?php 
namespace Modules\User\Contract\Backend;
interface RepositoryInterface
{  
    public function getAll();
    public function store(array $parms);
}