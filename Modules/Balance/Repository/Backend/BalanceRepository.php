<?php

namespace Modules\Balance\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Modules\Balance\Contract\Backend\BalanceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Balance\Entities\Balance;
use Modules\Balance\Entities\BalanceTransaction;
use Illuminate\Http\Request;
use App\Models\User;

class BalanceRepository implements BalanceRepositoryInterface
{
    use ApiResponser,AjaxPagination;
    
    public function getCurrentBalance()
    {
        $balance = 0;
        $current_balance = Balance::where('user_id',Auth::user()->id)->first();
        if($current_balance){
            $balance = $current_balance->balance;
        }

        $data=[
            'current_balance'=> $balance,
        ];
        return $this->successResponseArray($data, 'Successfully Get User Balance!');
    }

    public function getAll(){
        try {
            $data=[];
            $superadmin = $users = User::role(config('core.super-admin'))->pluck('id')->toArray();
            $user_balances =  Balance::whereNotIn('users.id',$superadmin)
                            ->rightJoin('users','users.id','balances.user_id')
                            ->select(['users.name','users.email','users.status','users.id','balances.balance'])
                            ->orderBy('users.name','DESC')
                            ->paginate(10);
            if($user_balances){
                foreach($user_balances as $user_balance){

                    $data[]=[
                        'id'            =>  $user_balance->id,
                        'name'          =>  $user_balance->name,
                        'email'          =>  $user_balance->email,
                        'balance'       =>  ($user_balance->balance)?$user_balance->balance:0.00,
                    ];
                }
                return $this->successResponseArray($data, 'Successfully All User Balance!',null,['link'=>$this->ajaxPaginateLink($user_balances)]);
            }
            return $this->errorResponse();
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    public function depositRequest(Request $request){
        try {
            
            $otp =getOTP();
            $transactionNo =getTransactionNo();
            $transaction = new BalanceTransaction();
            $transaction->transaction_id = $transactionNo;
            $transaction->user_id = $request->user_id;
            $transaction->type = BalanceTransaction::DEPOSIT;
            $transaction->amount = $request->deposit_amount;
            $transaction->status = BalanceTransaction::PENDING;
            $transaction->otp = $otp;
            $transaction->remark = $request->remark;
            $transaction->before_amount = null;
            $transaction->after_amount = null;
            $transaction->create_by  = Auth::id();
            $transaction->save();
            $data = [
                'transaction'=>$transactionNo,
            ];
            return $this->successResponseArray($data, 'Successfully Send Deposit Request!');
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    
    public function depositOTPVarify(Request $request){
        try {
            $otp = trim($request->deposit_otp);
            DB::beginTransaction();
            $transaction = new BalanceTransaction();
            $transaction = $transaction
                        ->where('transaction_id',$request->transaction_no)
                        ->where('status',BalanceTransaction::PENDING)
                        ->first();
            if(!$transaction){
                DB::rollBack();
                return $this->errorResponse();
            }
            if($transaction->otp != $otp){
                $transaction->status = BalanceTransaction::FAIL;
                $transaction->save();
                DB::commit();
                return $this->errorResponse();
            }
            $balance = Balance::where('user_id',$transaction->user_id)->first();
            if($balance){
                $transaction->before_amount = $balance->balance; 
                $balance->balance = $balance->balance + $transaction->amount;
            }else{
                $transaction->before_amount = 0 ;
                $balance = new Balance();
                $balance->balance = $transaction->amount;
                $balance->user_id = $transaction->user_id;
            }
            $transaction->after_amount = $balance->balance;
            $balance->save();
            $transaction->status = BalanceTransaction::SUCCESS;
            $transaction->save();
            $data = [
                'transaction'=>$transaction->transaction_id,
            ];
            DB::commit();
            return $this->successResponseArray($data, 'Successfully Recharge User Balance Account ! ( Transaction No '.$transaction->transaction_id.' )');
            
        }
        catch (Exception $e) {
            DB::rollBack();
            return $this->errorResponse();
        }
    }

    public function withdrawalRequest(Request $request){
        try {
            
            $otp = getOTP();
            $transactionNo = getTransactionNo();
            $transaction = new BalanceTransaction();
            $transaction->transaction_id = $transactionNo;
            $transaction->user_id = $request->user_id;
            $transaction->type = BalanceTransaction::WITHDRAWAL;
            $transaction->amount = $request->withdrawal_amount;
            $transaction->status = BalanceTransaction::PENDING;
            $transaction->otp = $otp;
            $transaction->remark = $request->remark;
            $transaction->before_amount = null;
            $transaction->after_amount = null;
            $transaction->create_by  = Auth::id();
            $transaction->save();
            $data = [
                'transaction'=>$transactionNo,
            ];
            return $this->successResponseArray($data, 'Successfully Send Withdrawal Request !');
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
    }
    
    public function withdrawalOTPVarify(Request $request){
        try {
            $otp = trim($request->deposit_otp);
            $transaction_no = $request->transaction_no;
            DB::beginTransaction();
            $transaction = new BalanceTransaction();
            $transaction = $transaction
                        ->where('transaction_id',$transaction_no)
                        ->where('status',BalanceTransaction::PENDING)
                        ->first();
            if(!$transaction){
                DB::rollBack();
                return $this->errorResponse();
            }
            if($transaction->otp != $otp){
                $transaction->status = BalanceTransaction::FAIL;
                $transaction->save();
                DB::commit();
                return $this->errorResponse();
            }
            // when otp currect
            $balance = Balance::where('user_id',$transaction->user_id)->first();
            if(!$balance || $balance->balance < $transaction->amount){
                $transaction->status = BalanceTransaction::FAIL;
                $transaction->save();
                DB::commit();
                return $this->errorResponse('Insufficient User Balance For Withdrawal');
            }
            $transaction->before_amount = $balance->balance ;
            $balance->balance = ($balance->balance - $transaction->amount);
            $balance->user_id = $transaction->user_id;
            $transaction->after_amount = $balance->balance;
            $balance->save();
            $transaction->status = BalanceTransaction::SUCCESS;
            $transaction->save();
            $data = [
                'transaction'=>$transaction->transaction_id,
            ];
            DB::commit();
            return $this->successResponseArray($data, 'Successfully Withdrawal From User Account! ('.$transaction->transaction_id.')');
        }
        catch (Exception $e) {
            DB::rollBack();
            return $this->errorResponse();
        }
    }
}