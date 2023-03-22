<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiLoginAuthenticationKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'authentican_key',
        'user_id',
        'driver',
        'login_time',
        'logout_time',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\ApiLoginAuthenticationKeyFactory::new();
    }
}
