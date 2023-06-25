<?php

namespace Modules\Booking\Repository\Backend;

use Modules\Core\Traits\ApiResponser;
use Modules\Core\Traits\AjaxPagination;
use Modules\Booking\Contract\Backend\BookingRepositoryInterface;
use App\Models\User;
use Modules\Booking\Entities\Booking;
use Auth;

class BookingRepository implements BookingRepositoryInterface
{
    use ApiResponser,AjaxPagination;

    protected $booking;
    function __construct(){
        $this->booking =  new Booking;
    }
    public function getBooking(){
        try {
            $data=[];
            $this->booking = $this->booking
                    ->join('shows','shows.id','bookings.show_id')
                    ->join('balance_transactions','balance_transactions.id','bookings.balance_tranction_id')
                    ->join('users','users.id','bookings.booking_by');
                    
            if(!Auth::user()->hasRole(config('core.super-admin'))){
                $this->booking = $this->booking->where('booking_by',Auth::user()->id);
                $this->booking = $this->booking->where('booking_for',date('y-m-d'));                
            }

            // show 
            // rename date
            $booking = $this->booking
                    ->select([
                                'bookings.id as id',
                                'bookings.booking_id',
                                'balance_transactions.transaction_id',
                                'bookings.booking_for',
                                'bookings.total',
                                'shows.show_time',
                                'users.email',
                                'bookings.mobile'])
                    ->paginate(10);
            if($booking){
                foreach($booking as $row){
                    $data[]=[
                        'id'                        => $row->id,
                        'booking_id'                => $row->booking_id,
                        'balance_transaction_id'    => $row->transaction_id,
                        'booking_by'                => $row->email,
                        'show'                      =>  $row->show_time,
                        'date'                      =>  $row->booking_for,
                        'total'                     =>  $row->total,
                        'mobile'                    =>  $row->mobile,  
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Get booking List!',null,['link'=>$this->ajaxPaginateLink($booking)]);
            }
            return $this->errorResponse(); 
        }
        catch (Exception $e) {
            return $this->errorResponse();
        }
        
    }
}