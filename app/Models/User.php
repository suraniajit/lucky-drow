<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles,SoftDeletes;
    const ACTIVE =  1;
    const DEACTIVE = 2;
    const ACTIVE_TEXT = 'Active';
    const DEACTIVE_TEXT = 'Deactive';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];
    public function allStatus(){
        return [
            self::ACTIVE => self::ACTIVE_TEXT,
            self::DEACTIVE => self::DEACTIVE_TEXT
        ];
    }
    public function getStatus($status_code){
        $option = $this->allStatus();
        return $option[$status_code];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
