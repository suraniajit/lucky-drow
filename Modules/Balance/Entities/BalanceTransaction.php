<?php

namespace Modules\Balance\Entities;

use Illuminate\Database\Eloquent\Model;
class BalanceTransaction extends Model
{
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
