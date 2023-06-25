<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class booking_detail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_id',
        'sysmbol_id',
        'price',
        'book',
        'total_price',
        'gst',
        'net_total'
    ];
    
}
