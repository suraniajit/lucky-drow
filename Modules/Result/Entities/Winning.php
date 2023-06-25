<?php

namespace Modules\Result\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class winning extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'booking_id',
        'sysmbol_id',
        'total_winning_price',
        'receved'
    ];
    
}
