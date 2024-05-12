<?php 
ob_start(); // to store the output without The Header
    session_start(); 
    $pagetitle ="Items";
        $nonavbar='';
        $num_rows='';
        include 'init.php';
        include 'Include/Template/navbar.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['submit'])){
            $search = $_POST['search'];
            $sql = ("SELECT  *
              FROM
                  car
              WHERE  price like  '%$search%' OR Model like '%$search%' ");
                        $result = $con->query($sql);
                        if ($result->rowCount() > 0) {
                            while ($item = $result->fetch(PDO::FETCH_ASSOC)) {
                            
                                echo '<div class="col-sm-6 col-md-4" >';
                                echo '<div class="thumbnail item-box" >';
                                echo "<img class='img-responsive' src='../admin/Uploads/avatars/" .$item['avatar'] . " 'alt='' style='height:310px;width:370px;'/>";
                                echo '<h3> <a href="item.php?Car_ID='. $item['Car_ID'] .'" style="color:black;text-decoration:none;font-size:40px;position:relative;left:8px">' . $item['Model'] . '</a></h3>';
                                    echo '<div class="caption">';
                                        echo '<p style="max-height:44px">'. $item['description'] .'</p>';
                                        echo    '<span class="fa fa-star checked" style="color:orange"></span>';
                                        echo     '<span class="fa fa-star checked" style="color:orange"></span>';
                                        echo        '<span class="fa fa-star checked" style="color:orange"></span>';
                                        echo    '<span class="fa fa-star" style="color:orange"></span>';
                                        echo   '<span class="fa fa-star" ></span>';
                            
                                            echo '<h4 class="pricee" style="color:orange">EGP '. $item['price'] .' Pound / Day</h4>';
                                            echo '<p> <a href="booking.php?Car_ID='. $item['Car_ID'] .'">' . '<i class="fa-solid fa-circle-plus fa-2xl" style="position:relative;left:300px;bottom:28px"></i>'. '</a></p>';
                                        echo '<div class="date" style="text-align:right;font-size:13px;color:#AAA" >'. $item['date'] .'</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }}
                        }else{
                            echo '<div class="alert alert-danger text-center">Sorry This Item Not Found In This Current Time</div>';

                        }
    }
                
	include $tpl . 'footer.php';
ob_end_flush(); //to print all output including The header
?>