<?php 
namespace Modules\Setting\Contract\Backend;
interface RepositoryInterface
{  
    public function getAll();
    public function store(array $parms);
}