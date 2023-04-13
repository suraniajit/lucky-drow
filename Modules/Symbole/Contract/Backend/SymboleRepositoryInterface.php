<?php 
namespace Modules\Symbole\Contract\Backend;
interface SymboleRepositoryInterface
{  
    public function getAll();
    public function store(array $parms);
}