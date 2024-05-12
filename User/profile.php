<?php 
    session_start();
    $pagetitle="My Profile";
    include 'init.php';
    if(isset($_SESSION['user_name'])){
        $getuser = $con->prepare("SELECT  * FROM users WHERE user_name = ? ");
        $getuser ->execute(array($_SESSION['user_name']));
        $info = $getuser->fetch();
    ?>
<!-- ------------------------------------------------------------------------------------------------ -->
<body style="background-color:#EEE">
    <h1 class="text-center" style="font-weight: bold;" >My Profile</h1>
    <div class="my-comments block"></div>
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading" style="background-color:orange">My Image</div>
                <div class="panel-body">
              <img class="img-responsive img-thumbnail img-circle center-block" src="design/Images/8.png" alt="" style="max-width:150px;height:100px"/>
                </div>
            </div>
        </div>
    </div>
    <div class="info block"></div>
        <div class="container">
            <div class="panel panel-primary" >
                <div class="panel-heading" style="background-color:orange">My Information</div>
                <div class="panel-body">
                    <ul class="list-unstyled" style="padding:10px">
                        <li style="padding:10px;background-color:#EEE">
                        <i class="fa fa-unlock-alt fa-fw"></i>
                        <span style="display:inline-block;width:120px">Name :</span> <?php  echo $info['user_name']; ?>
                    </li>
                        <li style="padding:10px">
                        <i class="fa fa-envelope fa-fw"></i>
                        <span style="display:inline-block;width:120px">My Email :</span> <?php  echo $info['user_email'];   ?>
                    </li>
                        <li style="padding:10px;background-color:#EEE">
                        <i class="fa fa-user fa-fw"></i>
                        <span style="display:inline-block;width:120px">Full Name :</span> <?php  echo $info['Fullname'];   ?>
                    </li>
                        <li style="padding:10px">
                        <i class="fa fa-calendar  fa-fw"></i>
                        <span style="display:inline-block;width:120px">Date :</span> <?php  echo $info['user_date'];   ?>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="my-ads block"></div>
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading" style="background-color:orange">My Latest Rented Cars.</div>
                <div class="panel-body">
                <div class="row">
                    <?php 
                        foreach(getitem('member',$info['user_id'], 1) as $items){
                            echo '<div class="col-sm-6 col-md-4">';
                                echo '<div class="thumbnail item-box">';
                                echo '<span class="price">$ '. $items['price'] .'</span>';
                                echo "<img class='img-responsive' src='../admin/Uploads/avatars/" .$items['avatar'] . " 'alt='' style='height:310px;width:370px;'/>";
                                echo '<div class="caption">';
                                        echo '<h3> <a href="item.php?Car_ID='. $items['Car_ID'] .'">' . $items['Model'] . '</a></h3>';
                                        echo '<p>'. $items['description'] .'</p>';
                                        echo '<div class="date" style="text-align:right;font-size:13px;color:#AAA" >'. $items['date'] .'</div>';

                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-comments block"></div>
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading" style="background-color:orange">Latest Comments</div>
                <div class="panel-body">
                    There Is No Comments To Show !!
                </div>
            </div>
        </div>
    </div>
    </body>
<!-- ---------------------------------------------------------------------------------------------------- -->
<?php
    }else {
        header('Location:index.php');
        exit();
    }
include $tpl . 'footer.php'; ?>