<?php

    function lang($phrase){
// To Change the language
        static $lang = array(
            'Message' => 'اهلا ',
            'Admin' => 'بحضرتك يا مدير'

        );

        return $lang[$phrase];

    }




?>