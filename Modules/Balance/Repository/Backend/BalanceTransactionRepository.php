<?php

namespace Modules\Balance\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Modules\Balance\Contract\Backend\BalanceTransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Modules\Balance\Entities\BalanceTransaction;

class BalanceTransactionRepository implements BalanceTransactionRepositoryInterface
{
    use ApiResponser,AjaxPagination;
    
    public function getUserBalanceTransaction($user_id)
    {
        try {
            $data=[];
            $balance_transactions = BalanceTransaction::where('user_id',$user_id)
                ->orderBy('created_at','DESC')
                ->paginate(10);
            if($balance_transactions){
                foreach($balance_transactions as $transactions){
                    $data[]=[
                        'transaction_id'=>  $transactions->transaction_id,
                        'type'          =>  $transactions->type,
                        'amount'        =>  $transactions->amount,
                        'status'        =>  $transactions->status,
                        'remark'        =>  $transactions->remark,
                        'after_amount'  =>  $transactions->after_amount,
                        'date_time'     =>  getDateTime($transactions->updated_at),
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Balance Transaction!',null,['link'=>$this->ajaxPaginateLink($balance_transactions)]);
            }
            return $this->errorResponse();

        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
        
        return $this->successResponseArray($data, 'Successfully Get User Balance!');
    }
}