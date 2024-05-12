<?php
// put any path here and other folders will inherit from this folder

include 'connect.php'; //connect to database
$tpl = 'Include/Template/'; //template directory
$css = 'Design/CSS/'; //css directory
$js = 'Design/JS/'; //js directory
$func = 'Include/Functions/'; //Functions directory
include  $func .'funcs.php';
include 'Include/Languages/Eng.php';
include  $tpl . 'header.php';

if(!isset($nonavbar)){
    include $tpl . 'navbar.php';
}

?>
