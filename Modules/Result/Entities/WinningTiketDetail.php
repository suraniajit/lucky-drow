<?php

namespace Modules\Result\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WinningTiketDetail extends Model
{
    protected $table ="winning_tiket_details";
    protected $fillable = [
    'winning_show_id',
    'booking_id',
    'winning_tiket',
    'winning_price'
    ];
}
