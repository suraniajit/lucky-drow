<?php 
namespace Modules\Setting\Contract\Backend;
interface SettingRepositoryInterface
{  
    public function save(array $parms);
    public function getSettingData();
}