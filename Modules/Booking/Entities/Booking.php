<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_id',           //will gene unique number
        'balance_tranction_id', //transaction of balance id
        'show_id',              // show id
        'booking_for',          // date for booking 2023/12/1 this forment
        'total',                // total price
        'gst',                  //total gst
        'net_total',            // net total
        'booking_by',           // village admin id
        'mobile'                // booking number ,it's optional
    ];
    
}
