<?php

// Error Reporting
ini_set('display_errors','On');
error_reporting(E_ALL);
// put any path here and other folders will inherit from this folder

include 'connect.php'; //connect to database
$sessionuser=""; 
if(isset($_SESSION['sessionuser'])){
    $sessionuser = $_SESSION['user'];
}
$tpl = 'Include/Template/'; //template directory
$css = 'design/CSS/'; //css directory
$js = 'design/JS/'; //js directory
$func = 'Include/Functions/'; //Functions directory
include  $func .'funcs.php';
include 'Include/Languages/Eng.php';
include  $tpl . 'header.php';

if(!isset($nonavbar)){
    include $tpl . 'navbar.php';
}
if(!isset($header)){
    include $tpl . 'header.php';
}


?>
