<?php
ob_start();
session_start();

if(isset($_SESSION['user_name'])){
    $pagetitle = 'Dashboard';
    include 'init.php';
    // Dashboard Page
    $stmt2 = $con->prepare("SELECT COUNT(user_id) from users WHERE user_group_id !=1");
    $stmt2->execute();

    ?>
    <body style="background-image:url('Design/Images/5.jpg') ;background-size: cover; background-repeat: no-repeat;" >
    <div class="container home-stats">
        <h1 style="color:orange;text-align:center;font-size:60px;font-family:cursive;top:30px"> <i class="fa-solid fa-chart-simple" style="margin-right:15px ;" ></i> Dashboard</h1>
    <div class="row" style="margin-top: 35px;">
            <div class="col-md-3"  >
                <div class="stat members" style="background-color:orange; border: 1px solid #CCC; padding: 20px;border-radius:30px;text-align:center;position:relative;overflow:hidden">
                <i class="fa fa-users" style="font-size:70px"></i>
                <div class="info" style="float:right">
                Total Employees
                <span style="display: block;font-size:60px;font-family:cursive"><a href="members.php?do=Manage"><?php echo countusers('user_id','users')?></a></span>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat pending" style="background-color:#EEE; border: 1px solid #CCC; padding: 20px;border-radius:30px;text-align:center;position:relative;overflow:hidden">
                <i class="fa fa-user-plus" style="font-size:70px"></i>
                <div class="info" style="float:right">
                Pending Customers 
                <span style="display: block;font-size:60px;font-family:cursive"><a href="members.php?do=Manage&page=pending"><?php echo check("approval","users", 0) ?></a></span>
                </div>
            </div>
            </div>
            <div class="col-md-3">
                <div class="stat items" style="background-color:orange; border: 1px solid #CCC; padding: 20px;border-radius:30px;text-align:center;position:relative;overflow:hidden">
                <i class="fa fa-tag" style="font-size:70px"></i>
                <div class="info" style="float:right">
                Total Items
                <span style="display: block;font-size:60px;font-family:cursive"><a href="items.php?do=Manage"><?php echo countitems("Car_ID","car") ?></span>
                </div>
            </div>
            </div>
            <div class="col-md-3"  >
                <div class="stat comments" style="background-color:#EEE; border: 1px solid #CCC; padding: 20px;border-radius:30px;text-align:center;position:relative;left:870px;bottom:150px;overflow:hidden">
                <i class="fa fa-comments" style="font-size:95px"></i>
                <div class="info" style="float:right">
                Total Comments    
                <span style="display: block;font-size:160px;font-family:cursive"><a href="category.php?do=Manage">8</span>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
 <div class="container latest" style="margin-top: -80px;" >
        <div class="row">
            <div class="col-sm-6">
              <div class="panel panel-default">
                <?php 
                    $thelatestuser = 4;
                
                ?>
                <div class="panel-heading">
                    <i class="fa fa-users"></i>
                        <!-- Latest <?php echo $thelatestuser ?>  Users  -->
                        <span class="pull-right">
                        <i class ="fa fa-plus fa-lg"></i>
                        </span>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled latest-users" style="margin-bottom: 0%;background-color:#EEE" >
                        <?php 
                        $thelatestuser = getlatest('*','users','user_id',$thelatestuser ); //To print the latest users in the system
                        foreach($thelatestuser as $user){
                            echo "<li style='padding:8px ;overflow:hidden'>";
                                echo $user['user_name'];
                                echo '<a href="members.php?do=Edit&userid=' . $user['user_id'] . '">';
                                        echo "<span class='btn btn-success pull-right'>";
                                            echo '<i class="fa fa-edit" style="position:relative;right:5px"></i>Edit';
                                                if($user['approval'] == 0){
                                                    echo '<a href="members.php?do=Activate&userid='.$user['user_id']. ' "class="btn btn-info pull-right " style="position:relative;right:5px">
                                                    <i class="fa fa-check-square" aria-hidden="true"></i>Activate </a>';
                    
                                                }

                                        echo '</span>';
                                echo '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
              </div>    
            </div>
            <div class="col-sm-6">
              <div class="panel panel-default">
                <div class="panel-heading"  style ="color:blue;">
                    <i class="fa fa-tag" style ="color:blue;"></i>
                        Latest Items
                        <span class="pull-right">
                        <i class ="fa fa-plus fa-lg"></i>
                        </span>
                </div>
                <div class="panel-body">
                <ul class="list-unstyled latest-users" style="margin-bottom: 0%;background-color:#EEE" >
                <?php 
                       $thelatestuser = getlatest('*','car','Car_ID',5);//To print the latest users in the system
                       foreach($thelatestuser as $user){
                        echo "<li style='padding:8px ;overflow:hidden'>";
                        echo $user['Model'];
                        echo '<a href="items.php?do=Edit&Car_ID=' . $user['Car_ID'] . '">';
                                echo "<span class='btn btn-success pull-right'>";
                                    echo '<i class="fa fa-edit" style="position:relative;right:5px"></i>Edit';
                                        if($user['approve'] == 0){
                                            echo '<a href="items.php?do=Approve&Car_ID='.$user['Car_ID']. ' "class="btn btn-info pull-right " style="position:relative;right:5px">
                                            <i class="fa fa-check-square" aria-hidden="true"></i>Activate </a>';
                                        }

                                echo '</span>';
                        echo '</a>';
                    echo '</li>';
                }
                    ?>
                </div>
              </div>    
            </div>
        </div>
    </div>
</div>
    </body> 
    <?php include $tpl . 'footer.php';
}else{
    header('Location: index.php');
    exit();

}
ob_end_flush();

?>