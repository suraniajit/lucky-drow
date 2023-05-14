
<?php
/**
*   Develop By Surani Ajit
*   Gmail:-suraniajit128335@gmail.com
*
*/

 $menuArray =
            [
               [
                  "icon"=>"fa fa-user nav-icon",
                  'title'=>__('user::user/labels.user-slider-main-title'),
                  'sub-menu'=>[
                           [
                              'icon'=>'fa fa-users nav-icon',
                              'href'=>route('admin.user.index'),
                              'title'=>__('user::user/labels.user-slider-title'),
                              'middleware'=>'admin.user.index', 
                           ],
                           [
                              'icon'=>'fa fa-money nav-icon',
                              'href'=>route('admin.balance.index'),
                              'title'=>__('balance::balance/labels.balance-slider-title'),
                              'middleware'=>'admin.balance.index', 
                           ],      
                      ],
                  ],
                  
           ];

?>