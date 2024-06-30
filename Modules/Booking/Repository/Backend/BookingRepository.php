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
use Modules\Balance\Entities\Balance;
use Modules\Balance\Entities\BalanceTransaction;

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
                    ->leftjoin('shows','shows.id','bookings.show_id')
                    ->leftjoin('balance_transactions','balance_transactions.id','bookings.balance_tranction_id')
                    ->leftjoin('users','users.id','bookings.booking_by');
                    
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
                    ->orderBy('bookings.id', 'DESC')
                    ->paginate(5);
            if($booking){
                foreach($booking as $row){
                    $data[]=[
                        'id'                        => $row->id,
                        'booking_id'                => $row->booking_id,
                        'balance_transaction_id'    => $row->transaction_id,
                        'booking_by'                => $row->email,
                        'show'                      =>  date('h:i:s a',strtotime($row->show_time)),
                        'date'                      =>  $row->booking_for,
                        'total'                     =>  $row->total,
                        'mobile'                    =>  $row->mobile,  
                    ];
                }
                return $this->successResponseArray($data, 'Successfully Get booking List!',null,[
                    'link'=>$this->ajaxPaginateLink($booking),
                    'current_page'=> $booking->currentPage(),
                'per_page'=> $booking->perPage(),]);
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
            $data = [];
            $show_model = new Show();
            $symbole_model = new Symbole();
            $tiket_price = getSetting('tiket_price');
            $booking_no = getBookingNo();
            $final_total = 0;
            $user_id = Auth::user()->id;
            $show_data = Show::where('id',$param['show_id'])->first();
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
            if(!checkEnoughBalance($total_amount)){
                return $this->errorResponseArray('No have sufficient balance for this order'); 
            }
            //cut balance
            if(!Auth::user()->hasRole(config('core.super-admin'))){
                $balance = new Balance();
                $balance =$balance->where('user_id',$user_id)->first();
                $old_balance = $balance->balance;
                $new_balance = $balance->balance - $total_amount;
                $balance->balance = $new_balance ;
                $balance->save();
                $transactionNo = getTransactionNo();
                $balance_transaction = new BalanceTransaction();
                $balance_transaction->transaction_id = $transactionNo;
                $balance_transaction->user_id  = $user_id;
                $balance_transaction->type =  BalanceTransaction::WITHDRAWAL;
                $balance_transaction->amount = $total_amount;
                $balance_transaction->status = BalanceTransaction::SUCCESS;
                $balance_transaction->remark ='order booking '.$booking_no;
                $balance_transaction->before_amount = $old_balance;
                $balance_transaction->after_amount = $new_balance;
                $balance_transaction->create_by = $user_id;
                $balance_transaction->save();
            }
            //save booking main detail 
            $this->booking->booking_id = $booking_no;
            $this->booking->balance_tranction_id = (!Auth::user()->hasRole(config('core.super-admin')))?$balance_transaction->id:null;
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
                        'symbol_id'=>$symbole_id,
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