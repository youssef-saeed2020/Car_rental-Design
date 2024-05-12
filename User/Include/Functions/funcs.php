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
        $stmt2 = $con->prepare("SELECT COUNT($item) from $table WHERE user_group_id !=1");
        $stmt2->execute();
        return $stmt2->fetchColumn();
    }
// get latest members from the database
function getcat(){
    global $con;
    $getcat = $con->prepare("SELECT *  FROM category ORDER BY category_id DESC");
    $getcat->execute();
    $cats = $getcat->fetchAll();
    return $cats;

}
function countitems($item, $table){
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT($item) from $table ");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}
function getitems($cat_id, $approve = NULL){
    global $con;
    if($approve == NULL){
        $sql = 'AND approve = 1';
    }else{
        $sql = NULL;
    }
    $getitems = $con->prepare("SELECT *  FROM car WHERE cat_id = ?  ORDER BY Car_ID DESC");
    $getitems->execute(array($cat_id));
    $items = $getitems->fetchAll();
    return $items;

}
function getuserstatus($user){
    global $con;
    $stmtx = $con->prepare("SELECT
                                user_name,
                                approval
                                FROM users
                                WHERE user_name = ?
                                AND stat = 'C' ");
    $stmtx->execute(array($user));
    $status = $stmtx->rowCount();
    return $status;

}
function getitem($where, $value, $approve = NULL){
    global $con;
    if($approve == NULL){
        $sql = 'AND approve = 1';
    }else{
        $sql = NULL;
    }
    $getitems = $con->prepare("SELECT *  FROM car WHERE $where = ? $sql ORDER BY Car_ID DESC");
    $getitems->execute(array($value));
    $items = $getitems->fetchAll();
    return $items;

}

ob_end_flush();
?>