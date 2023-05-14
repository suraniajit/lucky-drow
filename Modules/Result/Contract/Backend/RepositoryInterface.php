<?php 
namespace Modules\Result\Contract\Backend;
interface RepositoryInterface
{  
    public function getAll();
    public function store(array $parms);
}