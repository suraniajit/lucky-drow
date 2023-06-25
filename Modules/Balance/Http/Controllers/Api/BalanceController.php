<?php

namespace Modules\Balance\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Balance\Repository\Backend\BalanceRepository;
use Modules\Balance\Http\Requests\DepositRequest;
use Modules\Balance\Http\Requests\DepositOtpVarifyRequest;
use Modules\Balance\Http\Requests\WithdrawalRequest;
use Modules\Balance\Http\Requests\WithdrawalOtpVrifyRequest;


class BalanceController extends Controller
{
    protected $balanceRepository;
    function __construct(){
        $this->balanceRepository = new BalanceRepository();
    }
    public function getCurrentBalance(){
        return $this->balanceRepository->getCurrentBalance();
    }
    public function index()
    {
        $response =  $this->balanceRepository->getAll();
        return $response;
    }
    public function depositRequest(DepositRequest $request){
        $response =  $this->balanceRepository->depositRequest($request);
        return $response;
    }
    public function depositOTPVarify(DepositOtpVarifyRequest $request){
        $response =  $this->balanceRepository->depositOTPVarify($request);
        return $response;
    }
    public function withdrawalRequest(WithdrawalRequest $request){
        $response =  $this->balanceRepository->withdrawalRequest($request);
        return $response;
    }
    public function withdrawalOTPVarify(WithdrawalOtpVrifyRequest $request){
        $response =  $this->balanceRepository->withdrawalOTPVarify($request);
        return $response;
    }
}
