<?php

namespace Modules\Symbole\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Symbole extends Model
{
    use SoftDeletes;
    const ENABLE =  1;
    const DISABLE = 2;
    const ENABLE_TEXT =  'Enable';
    const DISABLE_TEXT = 'Disable';
    const SYMBOLE_PATH = 'data/symbole';
    protected $fillable = [
        'name',
        'file',
        'status'
    ];
    
    public function getSymbolePath(){
        return self::SYMBOLE_PATH;
    }
    public function getSymbole($image_name){
        return self::SYMBOLE_PATH.'/'.$image_name;
    }
    
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
