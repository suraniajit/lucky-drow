<?php

namespace Modules\Balance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalanceTransaction extends Model
{
    use SoftDeletes;
    protected $table = 'balance_transactions';
     const WITHDRAWAL = 'withdrawal';
     const DEPOSIT = 'deposit';
     const PENDING = 'pending';
     const SUCCESS = 'success';
     const FAIL = 'fail';
     
     
    protected $fillable = [
        'transaction_id',
        'user_id',
        'type',
        'amount',
        'status',
        'otp',
        'remark',
        'before_amount',
        'after_amount',
        'create_by',
    ];
    
}
