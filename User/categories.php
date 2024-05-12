<?php include 'init.php'; 
$pagetitle="Accelerate Auto";
?>
<body style="background-color:#EEE">
<div class="container" style="background-color: #EEE;">

<h1 class="text-center" style="color:orange;font-size:60px;font-family:cursive"><?php  str_replace(' ','-',$_GET['pagename'])?></h1>
    <div class="row">
        <?php 
            foreach(getitems($_GET['pageid']) as $items){
                    echo '<div class="col-xs-4" >';
                    echo '<div class="thumbnail item-box" >';
                    echo '<h5> <a href="item.php?Car_ID='. $items['Car_ID'] .'" style="color:black;text-decoration:none;font-size:22px;position:relative;left:8px;font-family:bold">' . $items['Model'] . '</a></h5>';
                    echo "<img class='img-responsive' src='../admin/Uploads/avatars/" .$items['avatar'] . " 'alt='' style='height:100%;width:100%;position:relative;'/>";

                    if($items['approve'] == 0){
                        
                        echo '<span class="approve-status" style="position:absolute;top:40px;left:0;background-color:orange;color:#FF;padding:px 5px">Waiting Approval</span>';
                    }
                        // echo '<h3> <a href="item.php?Car_ID='. $items['Car_ID'] .'" style="color:black;text-decoration:none;font-size:40px;position:relative;left:8px">' . $items['Model'] . '</a></h3>';
                        // echo "<img class='img-responsive' src='../admin/Uploads/avatars/" .$items['avatar'] . " 'alt='' style='height:310px;width:370px;'/>";
                        echo '<div class="caption">';
                            if($items['approve'] == 1){
                            
                            }else{
                                echo '<p>Please Wait While This item Approved</p>';
                            }
                            echo '<p style="max-height:44px;font-size:20px;position:relative;top:5px;">'. $items['description'] .'</p>';
                            echo    '<span class="fa fa-star checked" style="color:orange;position:relative;top:10px;"></span>';
                            echo     '<span class="fa fa-star checked" style="color:orange;position:relative;top:10px;"></span>';
                            echo        '<span class="fa fa-star checked" style="color:orange;position:relative;top:10px;"></span>';
                            echo    '<span class="fa fa-star" style="color:orange;position:relative;top:10px;"></span>';
                            echo    '<span class="fa fa-star" style="color:orange;position:relative;top:10px;"></span>';
                            
                            if($items['approve'] == 1){
                                echo '<h4 class="pricee" style="color:orange;position:relative;top:25px;font-size:20px;">$'. $items['price'] .' EGP / Day</h4>';
                                echo '<p> <a href="reserve.php?Car_ID='. $items['Car_ID'] .'">' . '<i class="fa-solid fa-circle-plus fa-2xl" style="position:relative;left:290px;bottom:4px"></i>'. '</a></p>';
                            }
                            echo '<div class="date" style="text-align:right;font-size:13px;color:#AAA" >'. $items['date'] .'</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

            }
        ?>

    </div>
</div>

<?php include $tpl . 'footer.php';?>

</body>


