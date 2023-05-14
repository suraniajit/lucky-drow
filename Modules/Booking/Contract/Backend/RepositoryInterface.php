<?php 
namespace Modules\Booking\Contract\Backend;
interface RepositoryInterface
{  
    public function getAll();
    public function store(array $parms);
}