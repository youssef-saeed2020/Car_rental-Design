<?php 
ob_start();
session_start();
$pagetitle = 'Office';
if(isset($_SESSION['user_name'])){
    include 'init.php';
    $do = ($_GET['do']) ? $_GET['do'] :'Manage';
    // start manage page
    if($do == 'Manage'){
        // select all users except  admin
        $query = '';
        if(isset($_GET['page']) && $_GET['page'] == 'pending'){ //for the activate for the Pendding customers
            $query = 'AND approval = 0';
        }
        $stmt = $con->prepare("SELECT * FROM office join users ON users.user_id = office.mgr_ssn");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        ?>
<body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
     <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa-solid fa-user-group"></i>  Manage My Offices- --------------</h1>
     <div class="container" >
        <div class="table-responsive" style="background-color: aliceblue;">
            <table class="maintable text-center table table-bordered" style="box-shadow: 0 10px 20px #CCC">
                <tr style="background-color: orange;">
                    <td>#ID</td>
                    <td>Office Name</td>
                    <td>Office Location</td>
                    <td>Manager Of The Location</td>
                    <!-- <td>Registerd Date</td> -->
                    <td>Control</td>
                </tr>
                <?php 
                    foreach($rows as $row){
                        echo '<td>' .$row['office_id'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['office_name'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['location'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['user_name'] . '</td>';
                            // echo '<td style="color:orange;font-size:20px">'.$row['user_date'] . '</td>';
                            echo '<td>
                            <a href="office.php?do=Edit&office_id=' . $row['office_id'] . ' "class="btn btn-success"style="padding:3px 10px;margin-left:5px"><i class="fa fa-edit"></i> Edit </a>
                            <a href="office.php?do=Delete&office_id='.$row['office_id']. ' "class="btn btn-danger confirm" style="padding:3px 10px;margin-left:5px"><i class="fa fa-close"></i> Delete </a>';
                            // if($row['approval'] == 0){
                            //    echo '<a href="members.php?do=Activate&userid='.$row['user_id']. ' "class="btn btn-info " style="padding:3px 10px;margin-left:5px"><i class="fa fa-check-square" aria-hidden="true"></i>Activate </a>';

                            // }
                            echo '</td>';
                        echo '</tr>';
                    }
                ?>
                <tr>
            </table>
        </div>
        <a href="office.php?do=Add" class="btn btn-warning"><i class="fa fa-plus"></i> Add New Office</a>;
     </div>
</body>

    <?php }elseif($do == 'Add'){ ?>
    <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
        <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa-solid fa-user"></i> Add New Office --------------</h1>
        <div class="container">
                <form class="form-horizontal" style="margin-bottom:10px" action="?do=Insert" method="POST">
                <!-- User Name field -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Office Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="officename" class="form-control" placeholder="Enter Office Name" autocomplete="off"  required ="required"/>
                        </div>
                    </div>
                    <!-- User Password Field -->
                    <div class="form-group form-group-lg" style="margin-left:140px" >
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Office Location</label>
                        <div class="col-sm-6">
                            <input type="text" name="officelocation" class="form-control" placeholder="Enter Office Location" required="required"/>
                            <!-- <i class="show-pass fa fa-eye fa-2x" style="position:absolute; Top:6px; right: 20px; "></i> -->
                        </div>
                    </div>
                    <!-- user Email -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Office Member</label>
                                <div class="col-sm-6">
                                    <select  name="category" style="height: 40px; width:476px" >
                                        <option value="0">.....</option>
                                        <?php 
                                      $stmt5 = $con->prepare("SELECT * FROM users WHERE stat = 'E' ");
                                      $stmt5->execute();
                                      $user = $stmt5->fetchAll();
                                      foreach ($user as $user){
                                        echo "<option value='"  .$user['user_id']  . "'>".$user['user_name'] . "</option>";
                                      }
                                      ?>
                                    </select>
                                </div>
                            </div>
                    <!-- User Full Name -->
                    <!-- For The Button -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Add Member" class="btn btn-warning btn-lg" style="font-family: cursive;" />
                        </div>
                    </div>
                </form>
        </div>
    
    <?php 

    }elseif($do == 'Insert'){
        // insert member page
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<body style='background-image:url('Design/Images/5.jpg') ;background-size:cover' >";

            echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Insert Member --------------</h1>';
            echo "<div class='container'>";

            // Get Variables from the form
            $user       = $_POST['officename'];
            $office       = $_POST['officelocation'];
            $category      = $_POST['category'];
            
            // Validate the Form 
            $formerrors = array();

            if(strlen($user) < 4){
                $formerrors[] ='Username must be at least<strong> 4 </strong> characters';
            }
            // if(strlen($user) > 20){
            //     $formerrors[] = ' Username must not be more than <strong>20 </strong>characters';
            // }

            if(empty($office)){
                $formerrors[] = 'Username can not be <strong>empty</strong>';
            }
            if(empty($user)){
                $formerrors[] = 'Password can not be <strong>empty</strong>';
            }
            if(empty($category)){
                $formerrors[] = 'Full name can not be <strong>empty</strong>';
            }
            // if(empty($email)){
            //     $formerrors[] = 'Email can not be <strong>empty</strong>';
            // }
            foreach($formerrors as $error){
                echo '<div class="alert alert-danger">' . $error .'<br/>';
            }
            // Check if there is no error do update for the data
            if(empty($formerrors)){
                $checkitem = check("office_name","office", $user);
                if($checkitem == 1){
                    echo '<div class="container">';
                    $theMsg = "<div class='alert alert-danger'>Sorry This Name is Already <strong>exist</strong></div>";
                    redirect($theMsg,'back',1);
                    echo '</div>';
                } else {

                        //Insert The data with the new information
                        $stmt = $con->prepare("INSERT INTO office (office_name, location , mgr_ssn) 
                        Values(:zname, :zlocation, :zmanager )");
                        $stmt->execute(array(
                            'zname'             => $user,
                            'zlocation'       => $office,
                            'zmanager'         => $category,

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
        $office_id = isset($_GET['office_id']) && is_numeric($_GET['office_id']) ? intval($_GET['office_id']) : 0;

        $stmt = $con->prepare("SELECT * FROM office WHERE office_id = ? LIMIT 1");
        $stmt->execute(array($office_id));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        //if There is such id fetch it 
        if($stmt->rowCount() > 0){ ?>
    <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
        <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa-solid fa-user-pen"></i> Edit Office --------------</h1>
        <div class="container">
                <form class="form-horizontal" style="margin-bottom:10px" action="?do=Update" method="POST">
                <input type="hidden" name="office_id" value="<?php echo $office_id ?>" />
                <!-- User Name field -->
                    <div class="form-group form-group-lg" style="margin-left:140px">
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Office Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="officename" class="form-control" placeholder="Enter Office Name" autocomplete="off" value="<?php echo $row['office_name'] ?>" required ="required"/>
                        </div>
                    </div>
                    <!-- User Password Field -->
                    <div class="form-group form-group-lg" style="margin-left:140px" >
                        <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Office Location</label>
                        <div class="col-sm-6">
                        <input type="text" name="location" class="form-control" placeholder="Enter Office location" autocomplete="off" value="<?php echo $row['location'] ?>" required ="required"/>

                        </div>
                    </div>
                    <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Office Manager</label>
                                <div class="col-sm-6">
                                    <select  name="user_id" style="height: 40px; width:476px" >
                                      <?php 
                                      $stmt5 = $con->prepare("SELECT * FROM users join office WHERE stat = 'E' GROUP BY user_id");
                                      $stmt5->execute();
                                      $user = $stmt5->fetchAll();
                                      foreach ($user as $user){
                                        echo "<option value='"  .$user['user_id']  . "'" ; 
                                        if($user['user_id'] == $user['mgr_ssn']){echo 'Selected ';}
                                        echo">".$user['user_name'] . "</option>";
                                      }
                                      ?>
                                    </select>
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

        echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Update Office --------------</h1>';
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Get Variables from the form

            $id         = $_POST['office_id'];
            $user       = $_POST['officename'];
            $loc         = $_POST['location'];
            $manager   = $_POST['user_id'];
            
            
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
            if(empty($manager)){
                $formerrors[] = 'Manager name can not be <strong>empty</strong>';
            }
       
            foreach($formerrors as $error){
                echo '<div class="alert alert-danger">' . $error .'<br/>';
            }
            // Check if there is no error do update for the data
            if(empty($formerrors)){
                            //Update The data with the new information
            $stmt = $con->prepare("UPDATE office SET office_name = ?, location = ? , mgr_ssn = ?  WHERE office_id = ?");
            $stmt->execute(array($user, $loc,$manager, $id));
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

                echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Delete Office --------------</h1>';
                echo "<div class='container'>";
                    $office_id = isset($_GET['office_id']) && is_numeric($_GET['office_id']) ? intval($_GET['office_id']) : 0;

                    $checkitem = check('office_id','office', $office_id); // is equal to select user_id from users where user_id = userid
                    
                    // if There is such id fetch it

                    if($checkitem > 0){ 
                        $stmt = $con->prepare("DELETE FROM office WHERE office_id = :zofficeid");
                        $stmt->bindParam(':zofficeid', $office_id);
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
        
    }
    include $tpl . 'footer.php';
    
}else{
    header('Location: ../index.html');
    exit();

}

ob_end_flush();
?>