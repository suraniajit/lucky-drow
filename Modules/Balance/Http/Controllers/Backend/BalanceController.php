<?php

namespace Modules\Balance\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BalanceController extends Controller
{
    public function index()
    {
        return view('balance::balance.index');
    }
    public function history($user_id)
    {
        return view('balance::balance.history')->with(['id'=>$user_id]);
    }
}
