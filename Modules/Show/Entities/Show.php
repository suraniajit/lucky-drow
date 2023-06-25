<?php

namespace Modules\Show\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Show extends Model
{
    use SoftDeletes;
    const ENABLE = 1;
    const DISABLE = 2;
    const ENABLE_TEXT = 'Enable';
    const DISABLE_TEXT = 'Disable';
    

    protected $fillable = [
        'show_name',
        'show_time',
        'show_day',
        'status',
        'start_date',
        'end_date',
    ];
    public function allStatus(){
        return [
            self::ENABLE => self::ENABLE_TEXT,
            self::DISABLE => self::DISABLE_TEXT
        ];
    }
    public function getStatus($status_code){
        $option = $this->allStatus();
        return $option[$status_code];
    }
    
}
