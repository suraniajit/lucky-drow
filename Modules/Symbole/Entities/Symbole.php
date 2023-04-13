<?php

namespace Modules\Symbole\Entities;

use Illuminate\Database\Eloquent\Model;



class Symbole extends Model
{
    const ENABLE =  1;
    const DISABLE = 2;
    const ENABLE_TEXT =  'Enable';
    const DISABLE_TEXT = 'Disable';
    const SYMBOLE_PATH = '';
    protected $fillable = [
        'name',
        'file',
        'status'
    ];
    
    public function getStatusOptions(){
        return [
            self::ENABLE=>self::ENABLE_TEXT,
            self::DISABLE => self::DISABLE_TEXT,            
        ];
    }
    public function getStatusText($status_code){
        $statusoption = $this->getStatusOptions();
        
        return $statusoption[$status_code];
    }
    
 
}
