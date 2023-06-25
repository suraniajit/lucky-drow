<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiLoginAuthenticationKey extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'authentican_key',
        'user_id',
        'driver',
        'login_time',
        'logout_time',
    ];    
}
