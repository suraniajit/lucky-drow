<?php 
namespace Modules\Balance\Contract\Backend;
use Illuminate\Http\Request;

interface BalanceTransactionRepositoryInterface
{  
    public function getUserBalanceTransaction($user_id);

}