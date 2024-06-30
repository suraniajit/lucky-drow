<?php

namespace Modules\User\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Result\Entities\WinningShow;
use Modules\Result\Entities\WinningTiketDetail;
use Modules\Booking\Entities\BookingDetail;
use Modules\Booking\Entities\Booking;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('user::backend.user.index');
    }
    public function test(){
        $drowDateTime = getNextDrowshowTime();
        if($drowDateTime['result']){
            $result = getLuckyDrowWinningSymbole($drowDateTime['drow_date'],$drowDateTime['time']);
            $result['show_id'] = $drowDateTime['show_id'];
            $result['drow_date'] = $drowDateTime['drow_date'];
            $this->saveWinningTiket($result);
        }

    }
    public function saveWinningTiket($result){
        $winning_show = new  WinningShow();
        $winning_show->sysmbol_id = $result['winner_symbole'];
        $winning_show->show_id = $result['show_id'];
        $winning_show->drow_date = $result['drow_date'];
        $winning_show->total_winning_price = $result['total_winning_amount'];
        $winning_show->collected_amount =$result['total_collection'];
        $winning_show->save();
        $winning_booking = new BookingDetail();
        // ::select([
        //     'booking_details.id as id',
        //     'booking_details.book as tiket_booking',
        //     'booking_details.price as tiket_price'
        //     ])
        $winning_booking->join('bookings','bookings.id','booking_details.booking_id')
            ->where('symbol_id',$result['winner_symbole'])
            ->where('show_id',$result['show_id'])
            ->where('booking_for',$result['drow_date'])
            ->groupBy('id')
            ->get()
            ->toArray();
        foreach($winning_booking as $booking){
        
           $winning_tiket_detail =  new WinningTiketDetail();

        //     WinningTiketDetail::create([
        //         $winning_show->id,
        //         $booking->id,
        //         $booking->tiket_booking,
        //         $booking->tiket_price,       
        //     ]);

        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
