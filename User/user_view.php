<?php
session_start();

include 'init.php';
$pagetitle="Accelerate Auto";

$categories = getcat();
foreach($categories as $cat){
    echo $cat['category_name'];
}



 ?>