
<?php
/**
*   Develop By Surani Ajit
*   Gmail:-suraniajit128335@gmail.com
*
*/
$menuArray = [
                [
                "icon"=>"fa fa-trophy nav-icon",
                'title'=>'Booking',
                'sub-menu'=>[
                        [
                            'icon'=>'fa fa-diamond nav-icon',
                            'href'=>route('admin.booking.index'),
                            'title'=>'Booking',
                            'middleware'=>'admin.booking.index', 
                        ],
                        [
                            'icon'=>'fa fa-trophy nav-icon',
                            'href'=>route('admin.result.index'),
                            'title'=>'Result',
                            'middleware'=>'admin.result.index', 
                        ],
                        [
                            'icon'=>'fa fa-history nav-icon',
                            'href'=>route('admin.result.history'),
                            'title'=>'History',
                            'middleware'=>'admin.result.history', 
                        ],  
                            
                    ],
                ],
            ];
?>