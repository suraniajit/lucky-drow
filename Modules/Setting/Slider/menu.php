
<?php
/**
*   Develop By Surani Ajit
*   Gmail:-suraniajit128335@gmail.com
*
*/

/**
* $menuArray =
*            [
*               [
*                   'icon'=>'far fa-circle nav-icon',
*                   'href'=>'#',
*                   'title'=>'setting',
*                   'middleware=>'', 
                ],
*               [
*                   'icon'=>'far fa-circle nav-icon',
*                    'href'=>'#',
*                    'title'=>'setting menu2',
*                    'middleware'=>'', 
*                ],
*                [
*                    'icon'=>'nav-icon fas fa-tachometer-alt',
*                    'title'=>'setting sub menu5',
*                    'sub-menu'=>[
*                            [
*                                'icon'=>'far fa-circle nav-icon',
*                                'href'=>'#',
*                                'title'=>'setting menu3',
*                                'middleware=>'',
*                            ],
*                            [
*                                'icon'=>'far fa-circle nav-icon',
*                                'href'=>'#',
*                                'title'=>'setting menu4',
*                                 'middleware=>'',
*                            ],      
*                    ]
*                ],
*           ];
*/

$menuArray =[
                [
                    'icon'=>'fa fa-cog nav-icon',
                    'href'=>route('admin.setting.index'),
                    'title'=>'Setting',
                    'middleware'=>'admin.setting.index', 
                ],
            ];
?>