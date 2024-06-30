<?php

namespace Modules\Result\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WinningShow extends Model
{
    protected $table ="winning_shows";
    protected $fillable = [
        'sysmbol_id',
        'show_id',
        'drow_date',
        'total_winning_price',
        'collected_amount',
    ];

}
