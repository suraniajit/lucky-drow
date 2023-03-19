<?php 
namespace Modules\Symbole\Contract\Backend;
interface RepositoryInterface
{  
    public function getAll();
    public function store(array $parms);
}