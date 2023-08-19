<?php

namespace Modules\Booking\Repository\Backend;

use Auth;
use App\Models\User;
use Modules\Show\Entities\Show;
use Modules\Symbole\Entities\Symbole;
use Modules\Core\Traits\ApiResponser;
use Modules\Booking\Entities\Booking;
use Modules\Core\Traits\AjaxPagination;
use Modules\Booking\Entities\BookingDetail;
use Modules\Booking\Contract\Backend\BookingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BookingRepository implements BookingRepositoryInterface
{
    use ApiResponser,AjaxPagination;

    protected $booking;
   protected $booking_detail;
    function __construct(){
        $this->booking =  new Booking;
        $this->booking_detail = new BookingDetail;


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
    public function saveBooking($param){
        try {
            DB::beginTransaction();
            //  DB::rollBack();
            //  DB::commit();
            $data = [];
            $show_model = new Show();
            $symbole_model = new Symbole();
            $tiket_price = getSetting('tiket_price');
            $final_total = 0;
            $show_data = Show::where('id',$param['show_id'])->first();
            // booking balance 6 k nahi
            // show available 6 k nahi
            if(!$show_data){
                return $this->errorResponseArray('Show Not Found'); 
            }
            $all_symbole = Symbole::pluck('id')->toArray();
            $total_amount = 0;
            foreach($param['symbole_id'] as  $key=>$symbole_id){
                if(!in_array($symbole_id,$all_symbole)){
                        return $this->errorResponseArray('Symbole Not Found'); 
                }
                if($param['symbole_booking_count'][$key] > 0){
                    $total_amount += $param['symbole_booking_count'][$key] * $tiket_price;
                }
            }
            //check have enught balace
            
            //cut balance

            //save main detail 
            $this->booking->booking_id = '123456';
            $this->booking->balance_tranction_id = 1;
            $this->booking->show_id = $param['show_id'];
            $this->booking->booking_for = date('Y-m-d');
            $this->booking->total = $total_amount;
            $this->booking->gst = 0;
            $this->booking->net_total = $total_amount;
            $this->booking->booking_by = Auth::user()->id;
            $this->booking->mobile = $param['mobile'];
            $this->booking->save();
            
            // save booking item detail
            $create_bokking_detail =[];
            foreach($param['symbole_id'] as  $key=>$symbole_id){
                if($param['symbole_booking_count'][$key] > 0){
                    $create_bokking_detail[]=[
                        'booking_id'=>$this->booking->id,
                        'sysmbol_id'=>$symbole_id,
                        'price'=>$tiket_price,
                        'book'=>$param['symbole_booking_count'][$key],
                        'total_price'=> $tiket_price * $param['symbole_booking_count'][$key],
                        'gst'=>0,
                        'net_total'=> $tiket_price * $param['symbole_booking_count'][$key],
                        'created_at'=> date('Y-m-d h:i:s'),
                        'updated_at'=> date('Y-m-d h:i:s'),
                        
                    ];
                }
            }
            BookingDetail::insert($create_bokking_detail);
            DB::commit();
            return $this->successResponseArray($data, 'successfuly confirmation request send!');
        }
        catch (Exception $e) {
            DB::rollBack();
            return $this->errorResponse();
        }
    }
}