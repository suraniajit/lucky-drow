<?php

namespace Modules\Show\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Show\Repository\Backend\ShowRepository;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $showRepository = new ShowRepository();
        $response =  $showRepository->getAll();
        
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $showRepository = new ShowRepository();
        return $showRepository->store($param);
    }
    public function statusUpdate(Request $request){
        $param = $request->all();
        $showRepository = new ShowRepository();
        return $showRepository->updateStatus($param);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $showRepository = new ShowRepository();
        return $showRepository->getEditData($id);
        return view('show::show');
    }

   
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $param = $request->all();
        $showRepository = new ShowRepository();
        return $showRepository->update($param);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $showRepository = new ShowRepository();
        return $showRepository->distroy($id);
    }
}
