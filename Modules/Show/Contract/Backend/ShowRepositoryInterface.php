<?php 
namespace Modules\Show\Contract\Backend;
interface ShowRepositoryInterface
{  
    public function getAll();
    public function store(array $parms);
    public function update(array $parms);
    
    
}