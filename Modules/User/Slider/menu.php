
<?php
/**
*   Develop By Surani Ajit
*   Gmail:-suraniajit128335@gmail.com
*
*/

 $menuArray =
            [
               [
                   'icon'=>'fa fa-users nav-icon',
                   'href'=>route('admin.user.index'),
                   'title'=>'User',
                   'middleware'=>'admin.user.index', 
                ],
                [
                  'icon'=>'fa fa-money nav-icon',
                  'href'=>route('admin.balance.index'),
                  'title'=>'Balance',
                  'middleware'=>'admin.balance.index', 
               ],
               
           ];

?>