<?php

namespace Modules\Booking\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Booking\Http\Requests\BookingRequest;
use Modules\Booking\Repository\Backend\BookingRepository;



class BookingController extends Controller
{
    protected $booking;
    function __construct(){
        $this->booking = new BookingRepository();
    }
    public function index()
    {
        return $this->booking->getBooking();
    }
    public function saveBooking(BookingRequest $request){
        return $this->booking->saveBooking($request->all());
    }
    public function edit($id){
        //return edit data
        return 44;
        // return $this->booking->getEdit($request->all());
    }
    public function update(Request $request){
        // update data
        // return $this->booking->saveBooking($request->all());
    }
    public function delete($id){
        // return $this->booking->saveBooking($request->all());
    }
    
    public function massDelete(Request $request){
        // return $this->booking->saveBooking($request->all());
    }
    
    
}
