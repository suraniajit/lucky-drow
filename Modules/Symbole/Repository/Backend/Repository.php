<?php

namespace Modules\Symbole\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Symbole\Contract\Backend\RepositoryInterface;
use App\Models\User;

class Repository implements RepositoryInterface
{
    use ApiResponser;

    public function getAll(){
        //code for get data
    }

    public function store($param){
        //code for store    
    }
}