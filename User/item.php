<?php 
    ob_start();
    session_start();
    $pagetitle="View Item";
    // $nonavbar=''; 
    include 'init.php';

    $Car_ID = isset($_GET['Car_ID']) && is_numeric($_GET['Car_ID']) ? intval($_GET['Car_ID']) : 0;

    $stmt = $con->prepare("SELECT 
                                car.*, category.category_name 
                            FROM
                                car
                            INNER JOIN
                                category ON car.cat_id = category.category_id
                            WHERE
                                Car_ID = ? LIMIT 1");
  
    $stmt->execute(array($Car_ID));

    $item = $stmt->fetch();
    $count = $stmt->rowCount();
    if($count > 0){

    
    
    ?>
<!-- ------------------------------------------------------------------------------------------------ -->
<body style="background-color:#EEE">
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
            echo "<img class='img-responsive img-thumbnail img-circle center-block' src='../admin/Uploads/avatars/" .$item['avatar'] . " 'alt='' style='height:310px;width:370px;'/>";
                ?>
        </div>
        <div class="col-md-9 item-info">
        <h1 class="text-center" style="font-weight: bold;font-size:50px" ><?php echo $item['Model'] ?></h1>            
            <p style="padding:10px;background-color:white"><i class="fa fa-unlock-alt fa-fw"></i> Information:<?php echo $item['description'] ?></p>
            <ul class="list list-unstyled">
                    <li style="padding:10px">
                    <i class="fa fa-calendar  fa-fw"></i>
                    <span>Rating:</span> 
                    <span class="fa fa-star checked" style="color:orange"></span>
                            <span class="fa fa-star checked" style="color:orange"></span>
                            <span class="fa fa-star checked" style="color:orange"></span>
                            <span class="fa fa-star" style="color:orange"></span>
                            <span class="fa fa-star"></span>
                </li>
                    <li style="padding:10px;background-color:white "><div>
                    <i class="fa fa-dollar fa-fw "></i>
                        <span>Price :</span><?php echo $item['price'] ?>$</div>
                    </li>
                    <li style="padding:10px ;"><div>
                    <i class="fa fa-building  fa-fw"></i>
                        <span>Made In :</span><?php echo $item['country_made'] ?></div></li>
                    <li style="padding:10px;background-color:white "><div>
                    <i class="fa fa-tags  fa-fw" ></i>
                        <span>Category :</span><?php echo $item['category_name'] ?></div></li>
            </ul>
        </div>
    </div>

    <hr style="border-top:1px solid #c9c9c9">
    <?php if(isset($_SESSION['user_name'])){ ?>

    <div class="row">
        <div class="col-md-offset-3">
            <div class="comment">
                <h3 style="margin:0 0 10px">Add Your Comment Here!</h3>
                <form action="<?php echo $_SERVER['PHP_SELF'] .'?Car_ID='. $item['Car_ID'] ?>" method="POST">
                <textarea name='comment' style="display:block;margin-bottom:10px;width:700px;height:120px" required="required" placeholder="Enter Your Comment about the item"></textarea>
                <input class="btn btn-primary" type="submit" value="Add My Comment">
                </form>
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $comment = filter_var($_POST['comment']);
                        $user_id = $item['member'];
                        $catid = $item['Car_ID'];
                        if(!empty($comment)){
                            $stmt = $con->prepare("INSERT INTO 
                                                        comments(comment,c_date,car_id,user_id)
                                                        VALUES (:comment, NOW(), :car_id, :user_id)");
                            $stmt->execute(array(
                                ':comment' => $comment,
                                ':car_id' => $catid,
                                ':user_id' => $user_id
                            ));
                            if($stmt){
                                echo "<div class='alert alert-success' style='max-width:220px'> Comment Added Successfully </div>";
                            }

                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <?php } else {
        echo '<a href="index.php"> Login </a> Required Or <a href="signup.php">Signup</a>';
    
    }?>
    <hr style="border-top:1px solid #c9c9c9">
    <?php 
       $stmt = $con->prepare("SELECT 
                                   comments.*, users.user_name 
                               FROM
                                   comments 
                               INNER JOIN
                                   users ON users.user_id = comments.user_id
                               WHERE
                                   Car_ID = ? 

                                ORDER BY c_id DESC   ");
     
       $stmt->execute(array($item['Car_ID']));
   
       $comments = $stmt->fetchAll();
    ?>
    <?php foreach($comments as $comment){    ?>
    <div class="comment-box" style="margin-bottom:20px">
            <div class="row">
                <div class="col-sm-2 text-center">
                <img class="img-responsive img-thumbnail img-circle center-block" src="design/Images/1.webp" alt="" 
                style="max-width: 100px;display:block;margin-bottom: 10px;"/>
                </div>
                <div class="col-sm-10">
                    <p class="lead" style="background-color:#EEE;position:relative;padding:10px;margin-top:15px"><?php echo $comment['comment']?></p>
                </div>
                </div>
                <style>
                    .comment-box .lead:before{
                        content:"";
                        width: 0;
                        height: 0;
                        border-width: 15px;
                        border-style: solid;
                        border-color:transparent orange transparent transparent;
                        position: absolute;
                        left: -28px;
                        top: 10px;
                    }
                </style>
    </div>
        <hr class="custom-hr" style="border-top: 1px solid #c9c9c9;">
        <?php }?>
        
</div>

</body>
<!-- ---------------------------------------------------------------------------------------------------- -->
<?php
    }else{
        echo 'There is nothing';
    }
include $tpl . 'footer.php';
ob_end_flush();
?>