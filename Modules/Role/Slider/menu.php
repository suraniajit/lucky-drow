
<?php
/**
*   Develop By Surani Ajit
*   Gmail:-suraniajit128335@gmail.com
*
*/
// $menuArray =[]

$menuArray =[
                [
                    'icon'=>'fa fa-solid fa-bars nav-icon',
                    'href'=>route('admin.role.index'),
                    'title'=>__('role::role/labels.role-slider-title'),
                    'middleware'=>'admin.role.index',
                ],
                [
                    'icon'=>'fa fa-lock nav-icon',
                    'href'=>route('admin.permission.index'),
                    'title'=>__('role::permission/labels.permission-slider-title'),
                    'middleware'=>'admin.permission.index',
                ]
];
?>