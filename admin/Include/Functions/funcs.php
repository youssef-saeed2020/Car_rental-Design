<?php 
// To print the title of each page
ob_start();
function gettitle(){
    global $pagetitle;
    if(isset($pagetitle)){
        echo $pagetitle;
    }else{
        echo 'Default ';
    }
}

//  Redirect  functions if there is  an error in accessing the page
function redirect($theMsg,$url = null, $seconds = 3){
    
    if($url === null){
        $url = 'index.php';
        // $link = 'Home Page';
    } else {

        $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !=='' ? $_SERVER['HTTP_REFERER']: 'index.php';
 
    }
header("refresh:$seconds;url=$url");
echo $theMsg;
echo "<div class ='alert alert-info'>You will Be directed after $seconds to $url Seconds</div>";
exit();
}

// Function to check the user is already in the database or not

function check($select, $from, $value){
    global $con;
    $stmt2 = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $stmt2->execute(array($value));
    $stmtcount = $stmt2->rowCount();
    return $stmtcount;
    }

    // Count number of users
function countusers($item, $table){
        global $con;
        $stmt2 = $con->prepare("SELECT COUNT($item) from $table WHERE user_group_id !=1 AND stat = 'E'");
        $stmt2->execute();
        return $stmt2->fetchColumn();
    }
// get latest members from the database
function getlatest($select, $table, $order, $limit = 5){
    global $con;
    $stmt3 = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC Limit $limit");
    $stmt3->execute();
    $rows = $stmt3->fetchAll();
    return $rows;

}
function countitems($item, $table){
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT($item) from $table ");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}

ob_end_flush();
?>