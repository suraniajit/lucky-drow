<?php 
namespace Modules\Balance\Contract\Backend;
use Illuminate\Http\Request;

interface BalanceRepositoryInterface
{  
    public function getAll();
    public function getCurrentBalance();
    public function depositRequest(Request $request);

}