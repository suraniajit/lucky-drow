
<?php
/**
*   Develop By Surani Ajit
*   Gmail:-suraniajit128335@gmail.com
*
*/


$menuArray =[
    [
        'icon'=>'fa fa-clock-o nav-icon',
        'href'=>route('admin.show.index'),
        'title'=>'Show',
        'middleware'=>'admin.show.index', 
    ],
    [
        'icon'=>'fa fa-diamond nav-icon',
        'href'=>route('admin.show.booking'),
        'title'=>'Booking',
        'middleware'=>'admin.show.booking', 
    ],
    [
        'icon'=>'fa fa-trophy nav-icon',
        'href'=>route('admin.show.result'),
        'title'=>'Result',
        'middleware'=>'admin.show.result', 
    ],
    [
        'icon'=>'fa fa-history nav-icon',
        'href'=>route('admin.show.history'),
        'title'=>'History',
        'middleware'=>'admin.show.history', 
    ],
     


];
?>