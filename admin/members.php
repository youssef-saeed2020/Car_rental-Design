<?php 
ob_start();
session_start();
$pagetitle = 'Members';
if(isset($_SESSION['user_name'])){
    include 'init.php';
    $do = ($_GET['do']) ? $_GET['do'] :'Manage';
    // start manage page
    if($do == 'Manage'){ 
        // select all users except  admin
        $query = '';
        if(isset($_GET['page']) && $_GET['page'] == 'pending'){//for the activate for the pendding customers
            $query = 'AND approval = 0';
        }

        $stmt = $con->prepare("SELECT * FROM users WHERE user_group_id != 1 $query");
        $stmt->execute();

        $rows = $stmt->fetchAll();
        ?>
<body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
     <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa-solid fa-user-group"></i>  Manage My Members --------------</h1>
     <div class="container" >
        <div class="table-responsive" style="background-color: aliceblue;">
            <table class="maintable text-center table table-bordered" style="box-shadow: 0 10px 20px #CCC">
                <tr style="background-color: orange;">
                    <td>#ID</td>
                    <td>Username</td>
                    <td>User Email</td>
                    <td>Full Name</td>
                    <td>Registerd Date</td>
                    <td>Control</td>
                </tr>
                <?php 
                    foreach($rows as $row){
                        if($row['stat'] == 'E'){ #To selest only The Employees In the System                         
                        echo '<td>' .$row['user_id'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['user_name'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['user_email'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['Fullname'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['user_date'] . '</td>';
                            echo '<td>
                            <a href="members.php?do=Edit&userid=' . $row['user_id'] . ' "class="btn btn-success"style="padding:3px 10px;margin-left:5px"><i class="fa fa-edit"></i> Edit </a>
                            <a href="members.php?do=Delete&userid='.$row['user_id']. ' "class="btn btn-danger confirm" style="padding:3px 10px;margin-left:5px"><i class="fa fa-close"></i> Delete </a>';
                            if($row['approval'] == 0){
                               echo '<a href="members.php?do=Activate&userid='.$row['user_id']. ' "class="btn btn-info " style="padding:3px 10px;margin-left:5px"><i class="fa fa-check-square" aria-hidden="true"></i>Activate </a>';

                            }
                            echo '</td>';
                        echo '</tr>';
                    }}
                ?>
                <tr>
            </table>
        </div>
        <a href="members.php?do=Add" class="btn btn-warning"><i class="fa fa-plus"></i> Add New Member</a>;
     </div>
</body>


    <?php }elseif($do == 'Add'){ ?>
    <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
        <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa-solid fa-user"></i> Add New Member --------------</h1>
        <div class="container">
                <form class="form-horizontal" style="margin-bottom:10px" action="?do=Insert" method="POST">
                <!-- User Name field -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Username</label>
                        <div class="col-sm-6">
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" autocomplete="off"  required ="required"/>
                        </div>
                    </div>
                    <!-- User Password Field -->
                    <div class="form-group form-group-lg" style="margin-left:140px" >
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Password</label>
                        <div class="col-sm-6">
                            <input type="password" name="password" class="password form-control" placeholder="Enter Your Strong Password" required="required"/>
                            <i class="show-pass fa fa-eye fa-2x" style="position:absolute; Top:6px; right: 20px; "></i>
                        </div>
                    </div>
                    <!-- user Email -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">User Email</label>
                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" autocomplete="off"  required ="required" />
                        </div>
                    </div>
                    <!-- User Full Name -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Full Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="fullname" class="form-control" placeholder="Enter Your Full Name" autocomplete="off" required ="required"/>
                        </div>
                    </div>
                    <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Status</label>
                                <div class="col-sm-6">
                                    <select  name="status" style="height: 40px; width:476px" >
                                        <option value="E" >Employee</option>
                                    </select>
                                </div>
                            </div>
                    <!-- For The Button -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Add Member" class="btn btn-warning btn-lg" style="font-family: cursive;" />
                        </div>
                    </div>
                </form>
        </div>
    </body>
    <?php 

    }elseif($do == 'Insert'){
        // insert member page
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<body style='background-image:url('Design/Images/5.jpg') ;background-size:cover' >";

            echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Insert Member --------------</h1>';
            echo "<div class='container'>";

            // Get Variables from the form
            $user       = $_POST['username'];
            $pass       = $_POST['password'];
            $email      = $_POST['email'];
            $fullname   = $_POST['fullname'];
            $hashedpass   = sha1($_POST['password']);
            
            // Validate the Form 
            $formerrors = array();

            if(strlen($user) < 4){
                $formerrors[] ='Username must be at least<strong> 4 </strong> characters';
            }
            if(strlen($user) > 20){
                $formerrors[] = ' Username must not be more than <strong>20 </strong>characters';
            }

            if(empty($user)){
                $formerrors[] = 'Username can not be <strong>empty</strong>';
            }
            if(empty($pass)){
                $formerrors[] = 'Password can not be <strong>empty</strong>';
            }
            if(empty($fullname)){
                $formerrors[] = 'Full name can not be <strong>empty</strong>';
            }
            if(empty($email)){
                $formerrors[] = 'Email can not be <strong>empty</strong>';
            }
            foreach($formerrors as $error){
                echo '<div class="alert alert-danger">' . $error .'<br/>';
            }
            // Check if there is no error do update for the data
            if(empty($formerrors)){
                $checkitem = check("user_name","users", $user);
                if($checkitem == 1){
                    echo '<div class="container">';
                    $theMsg = "<div class='alert alert-danger'>Sorry This Name is Already <strong>exist</strong></div>";
                    redirect($theMsg,'back',1);
                    echo '</div>';
                } else {

                        //Insert The data with the new information
                        $stmt = $con->prepare("INSERT INTO users (user_name, user_email, Fullname,stat, user_password,approval, user_date) 
                        Values(:zuser, :zuser_email, :zFullname,'E', :zuser_password,1, now() )");
                        $stmt->execute(array(
                            'zuser'             => $user,
                            'zuser_email'       => $email,
                            'zFullname'         => $fullname,
                            'zuser_password'    => $hashedpass

                        ));
                    $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . " Record Inserted Successfully!! </div>";
                    redirect($theMsg,'back',1);

            }}
            }else {
                echo '<div class="container">';
                $theMsg = '<div class="alert alert-danger"> Sorry you can not access this page</div>';
                redirect($theMsg);
                echo '</div>';

            }
            echo "</div>";
            echo "</body>";


    }elseif($do == 'Edit'){
    
        // fetch data from database to the edit form
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

        $stmt = $con->prepare("SELECT * FROM users WHERE user_id = ? LIMIT 1");
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        //if There is such id fetch it 
        if($stmt->rowCount() > 0){ ?>
    <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
        <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa-solid fa-user-pen"></i> Edit Customer --------------</h1>
        <div class="container">
                <form class="form-horizontal" style="margin-bottom:10px" action="?do=Update" method="POST">
                <input type="hidden" name="userid" value="<?php echo $userid ?>" />
                <!-- User Name field -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Username</label>
                        <div class="col-sm-6">
                            <input type="text" name="username" class="form-control" placeholder="User name" autocomplete="off" value="<?php echo $row['user_name'] ?>" required ="required"/>
                        </div>
                    </div>
                    <!-- User Password Field -->
                    <div class="form-group form-group-lg" style="margin-left:140px" >
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Password</label>
                        <div class="col-sm-6">
                            <input type="hidden" name="oldpassword" value="<?php echo $row['user_password'] ?>" />
                            <input type="password" name="newpassword" value="" class="form-control" placeholder="You Can Write New Password Only"/>

                        </div>
                    </div>
                    <!-- user Email -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">User Email</label>
                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" autocomplete="off" value="<?php echo $row['user_email'] ?>" required ="required" />
                        </div>
                    </div>
                    <!-- User Full Name -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Full Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="fullname" class="form-control" placeholder="Your Full Name" autocomplete="off" value="<?php echo $row['Fullname'] ?>" />
                        </div>
                    </div>
                    <!-- For The Button -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Save" class="btn btn-warning btn-lg" style="font-family: cursive;" />
                        </div>
                    </div>
                </form>
        </div>
    </body>
        
    <?php
      }else{
        // if There is no such  id print  error message
        echo '<div class="container">';
        $theMsg = '<div class="alert alert-danger"> There is No such ID</div>';
        redirect($theMsg);
        echo '</div>';
      }
    }elseif($do == 'Update'){ //Update Page
        echo "<body style='background-image:url('Design/Images/5.jpg') ;background-size:cover' >";

        echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Update Customer --------------</h1>';
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Get Variables from the form

            $id         = $_POST['userid'];
            $user       = $_POST['username'];
            $email      = $_POST['email'];
            $fullname   = $_POST['fullname'];
            
            $pass ='';
            // will check if the old password == new password then will do anything else will insert a new password with hashing
            
            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
            
            // Validate the Form 
            $formerrors = array();

            if(strlen($user) < 4){
                $formerrors[] ='Username must be at least<strong> 4 </strong> characters';
            }
            if(strlen($user) > 20){
                $formerrors[] = ' Username must not be more than <strong>20 </strong>characters';
            }

            if(empty($user)){
                $formerrors[] = 'Username can not be <strong>empty</strong>';
            }
            if(empty($fullname)){
                $formerrors[] = 'Full name can not be <strong>empty</strong>';
            }
            if(empty($email)){
                $formerrors[] = 'Email can not be <strong>empty</strong>';
            }
            foreach($formerrors as $error){
                echo '<div class="alert alert-danger">' . $error .'<br/>';
            }
            // Check if there is no error do update for the data
            if(empty($formerrors)){
                            //Update The data with the new information
            $stmt = $con->prepare("UPDATE users SET user_name = ?, user_email = ?, Fullname = ?, user_password = ? WHERE user_id = ?");
            $stmt->execute(array($user, $email, $fullname,$pass, $id));
            $theMsg ="<div class='alert alert-success'>" .$stmt->rowCount() . "Record Updated Successfully!! </div>";
            redirect($theMsg,'back',1); //Will redirect back to edit page
           
            }
        }else {
            echo '<div class="container">';
            $theMsg = '<div class="alert alert-danger"> Sorry You can not access this page</div>';
            redirect($theMsg); // will redirect back to index.php page
            echo '</div>';
        

        }
        echo "</div>";
        echo "</body>";




    }elseif($do == 'Delete'){
        // Delete member page
                // fetch data from database to the edit form
                echo "<body style='background-image:url('Design/Images/5.jpg') ;background-size:cover' >";

                echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Delete Customer --------------</h1>';
                echo "<div class='container'>";
                    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

                    $checkitem = check('user_id','users',$userid); // is equal to select user_id from users where user_id = userid
                    
                    // if There is such id fetch it

                    if($checkitem > 0){ 
                        $stmt = $con->prepare("DELETE FROM users WHERE user_id = :zuserid");
                        $stmt->bindParam(':zuserid', $userid);
                        $stmt->execute();

                        echo '<div class="container">';
                        $theMsg = "<div class='alert alert-success'>" .$stmt->rowCount() . " Record Deleted Successfully!! </div>";
                        redirect($theMsg); // will redirect back to index.php page
                        echo '</div>';
                    }else{
                        echo '<div class="container">';
                        $theMsg = "<div class='alert alert-danger'>This ID  is Not Exist </div>";
                        redirect($theMsg); // will redirect back to index.php page
                        echo '</div>';
                    }

                echo "</div>";
                echo "</body>";
    }  elseif($do == 'Activate'){
        echo "<body style='background-image:url('Design/Images/5.jpg') ;background-size:cover' >";

            echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Activate Member --------------</h1>';
            echo "<div class='container'>";
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            $checkitem = check('user_id','users',$userid); // is equal to select user_id from users where user_id = userid
            
            // if There is such id fetch it

            if($checkitem > 0){ 
                $stmt = $con->prepare("UPDATE users SET approval = 1 WHERE user_id = ?");
                $stmt->execute(array($userid));

                echo '<div class="container">';
                $theMsg = "<div class='alert alert-success'>" .$stmt->rowCount() . " Record Activated Successfully!! </div>";
                redirect($theMsg); // will redirect back to index.php page
                echo '</div>';
            }else{
                echo '<div class="container">';
                $theMsg = "<div class='alert alert-danger'>This ID  is Not Exist </div>";
                redirect($theMsg); // will redirect back to index.php page
                echo '</div>';
            }

        echo "</div>";
        echo "</body>";
    }
    include $tpl . 'footer.php';
}else{
    header('Location: index.php');
    exit();

}

ob_end_flush();
?>