<?php

namespace Modules\Themes\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ThemesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function setting(){
        return view('themes::backend.themes/themes_setting');
    }
}
