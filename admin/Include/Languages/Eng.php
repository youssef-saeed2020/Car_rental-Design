<?php

    function lang($phrase){
// To Change the language
        static $lang = array(
            'CATEGORIES' => 'Categories',
            'ITEMS'      => 'Items',
            'MEMBERS'    => 'Members',
            'Payments' => 'Payments',
            'OFFICE'       => 'Office',
            'COMMENTS'       => 'Comments',

           

        );

        return $lang[$phrase];

    }




?>