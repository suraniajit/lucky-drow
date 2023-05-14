<?php

namespace Modules\Balance\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Balance\Repository\Backend\BalanceRepository;

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
    public function depositRequest(Request $request){
        $response =  $this->balanceRepository->depositRequest($request);
        return $response;
    }
    public function depositOTPVarify(Request $request){
        $response =  $this->balanceRepository->depositOTPVarify($request);
        return $response;
    }
    public function withdrawalRequest(Request $request){
        $response =  $this->balanceRepository->withdrawalRequest($request);
        return $response;
    }
    public function withdrawalOTPVarify(Request $request){
        $response =  $this->balanceRepository->withdrawalOTPVarify($request);
        return $response;
    }
}
