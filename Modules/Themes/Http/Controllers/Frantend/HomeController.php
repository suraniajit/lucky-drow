<?php

namespace Modules\Themes\Http\Controllers\Frantend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('themes::frantend.index',[]);
    }
    

}
