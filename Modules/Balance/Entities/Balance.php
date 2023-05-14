<?php

namespace Modules\Balance\Entities;

use Illuminate\Database\Eloquent\Model;
class Balance extends Model
{
    protected $table = 'balances';
    
    protected $fillable = [
        'user_id',
        'balance',
    ];
    
}
