<?php

    function lang($phrase){
// To Change the language
        static $lang = array(
            'CATEGORIES' => 'Categories',
            'ITEMS'      => 'Items',
            'MEMBERS'    => 'Members',
            'STATISTICS' => 'Statistics',
            'OFFICE'       => 'Office',
            'COMMENTS'       => 'Comments',

           

        );

        return $lang[$phrase];

    }




?>