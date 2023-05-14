<?php

namespace Modules\Balance\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Balance\Repository\Backend\BalanceTransactionRepository;

class BalanceTransactionController extends Controller
{
    protected $balance_transaction_repository;
    function __construct(){
        $this->balance_transaction_repository = new BalanceTransactionRepository();
    }
    public function index($user_id)
    {
        $response =  $this->balance_transaction_repository->getUserBalanceTransaction($user_id);
        return $response;
    }
}
