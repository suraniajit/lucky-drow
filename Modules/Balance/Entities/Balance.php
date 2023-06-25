<?php

namespace Modules\Balance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use SoftDeletes;
    protected $table = 'balances';
    
    protected $fillable = [
        'user_id',
        'balance',
    ];
    
}
