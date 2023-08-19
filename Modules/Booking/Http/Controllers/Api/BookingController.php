<?php

namespace Modules\Booking\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
    public function saveBooking(Request $request){
        return $this->booking->saveBooking($request->all());
    }
}
