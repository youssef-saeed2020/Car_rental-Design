<?php 
ob_start(); // to store the output without The Header
    session_start(); 
    $pagetitle ="Items";
    
    if(isset($_SESSION['user_name'])){
        include 'init.php';
        
        $do = ($_GET['do']) ? $_GET['do'] :'Manage';
        // start manage page
        if($do == 'Manage'){
    
            $stmt = $con->prepare("SELECT car.*,category.category_name,users.user_name 
            FROM car 
            INNER JOIN category 
            ON category.category_id=car.cat_id
            INNER JOIN users 
            ON users.user_id = car.member");
            $stmt->execute();
    
            $rows = $stmt->fetchAll();
            ?>
    <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
         <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa-solid fa-user-group"></i>  Manage My Items --------------</h1>
         <div class="container" >
            <div class="table-responsive" style="background-color: aliceblue;">
                <table class="maintable text-center table table-bordered" style="box-shadow: 0 10px 20px #CCC">
                    <tr style="background-color: orange;">
                        <td>#ID</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Price</td>
                        <td>Adding Date</td>
                        <td>UserName</td>
                        <td>Category</td>
                        <td>Control</td>

                    </tr>
                    <?php 
                        foreach($rows as $row){
                            echo '<td>' .$row['Car_ID'] . '</td>';
                                echo '<td style="color:orange;font-size:20px">'.$row['Model'] . '</td>';
                                echo '<td style="color:orange;font-size:20px">'.$row['description'] . '</td>';
                                echo '<td style="color:orange;font-size:20px">'.$row['price'] . '</td>';
                                echo '<td style="color:orange;font-size:20px">'.$row['date'] . '</td>';
                                echo '<td style="color:orange;font-size:20px">'.$row['user_name'] . '</td>';
                                echo '<td style="color:orange;font-size:20px">'.$row['category_name'] . '</td>';

                                echo '<td>
                                <a href="items.php?do=Edit&Car_ID=' . $row['Car_ID'] . ' "class="btn btn-success"style="padding:3px 10px;margin-left:5px"><i class="fa fa-edit"></i> Edit </a>
                                <a href="items.php?do=Delete&Car_ID=' .$row['Car_ID']. ' "class="btn btn-danger confirm" style="padding:3px 10px;margin-left:5px"><i class="fa fa-close"></i> Delete </a>';
                                if($row['approve'] == 0){
                                    echo '<a 
                                    href="items.php?do=Approve&Car_ID='.$row['Car_ID']. ' "
                                    class="btn btn-info " style="padding:3px 10px;margin-left:5px">
                                    <i class="fa fa-check-square" aria-hidden="true"></i> Approve </a>';
                                 }
                                echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                    <tr>
                </table>
            </div>
            <a href="items.php?do=Add" class="btn btn-warning"><i class="fa fa-plus"></i> Add New Item</a>;
         </div>
    </body>
    
            

  <?php    }elseif($do == 'Add'){ ?>
            <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
                <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa fa-tag"></i> Add New Item --------------</h1>
                <div class="container">
                        <form class="form-horizontal" style="margin-bottom:10px" action="?do=Insert" method="POST" enctype="multipart/form-data">
                        <!-- User Name field -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" placeholder="Name of the Item"  required ="required"/>
                                </div>
                            </div>
                                        <!--For The description  -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Description</label>
                                <div class="col-sm-6">
                                    <input type="text" name="description" class="form-control" placeholder="Description of the Item"  required ="required"/>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Price</label>
                                <div class="col-sm-6">
                                    <input type="text" name="price" class="form-control" placeholder="Price of the Item"  required ="required"/>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Country Made</label>
                                <div class="col-sm-6">
                                    <input type="text" name="country" class="form-control" placeholder="Country of the Item"  required ="required"/>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Plate ID</label>
                                <div class="col-sm-6">
                                    <input type="text" name="plate" class="form-control" placeholder="Enter Plate ID" />
                                </div>
                            </div>
                            <!-- End Country Field -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Status</label>
                                <div class="col-sm-6">
                                    <select  name="status" style="height: 40px; width:476px" >
                                        <option value="0">.....</option>
                                        <option value="New OR Sort One">New OR Sort One</option>
                                        <option value="Second Hand">Second Hand</option>
                                        <option value="Third Hand">Third Hand</option>
                                        <option value="Fourth Hand">Fourth Hand</option>

                                 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Members</label>
                                <div class="col-sm-6">
                                    <select  name="member" style="height: 40px; width:476px" >
                                        <option value="0">.....</option>
                                      <?php 
                                    //   
                                      $stmt5 = $con->prepare("SELECT * FROM users  WHERE stat ='E' GROUP BY user_id ");
                                      $stmt5->execute();
                                      $users = $stmt5->fetchAll();
                                      foreach ($users as $User){
                                        echo "<option value='"  .$User['user_id']  . "'>".$User['user_name'] . "</option>";
                                      }
                                      ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Office Location</label>
                                <div class="col-sm-6">
                                    <select  name="office" style="height: 40px; width:476px" >
                                        <option value="0">.....</option>
                                      <?php 
                                      $stmt5 = $con->prepare("SELECT * FROM office ");
                                      $stmt5->execute();
                                      $user = $stmt5->fetchAll();
                                      foreach ($user as $user){
                                        echo "<option value='"  .$user['office_id']  . "'>".$user['office_name'] . "</option>";
                                      }
                                      ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Category</label>
                                <div class="col-sm-6">
                                    <select  name="category" style="height: 40px; width:476px" >
                                        <option value="0">.....</option>
                                      <?php 
                                      $stmt5 = $con->prepare("SELECT * FROM category");
                                      $stmt5->execute();
                                      $user = $stmt5->fetchAll();
                                      foreach ($user as $user){
                                        echo "<option value='"  .$user['category_id']  . "'>".$user['category_name'] . "</option>";
                                      }
                                      ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label" style="color: orange;position: relative; left: 130px;">Item Image</label>
                                <div class="col-sm-8 col-md-5" style="position: relative; left: 130px;" >
                                    <input type="file"  name="avatar" class="form-control" required="required">
                            </div>
                            </div>

                            <!-- For The Button -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" value="Add Item" class="btn btn-warning btn-lg" style="font-family: cursive;" />
                                </div>
                            </div>
                        
                        </form>
                </div>
                </div>
            </body>

       <?php }elseif($do == 'Insert'){
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<body style='background-image:url('Design/Images/5.jpg') ;background-size:cover' >";

            echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Insert Item --------------</h1>';
            echo "<div class='container'>";

            // Get Variables from the form
            $avatarName     = $_FILES['avatar']['name'];
            $avatarsize   = $_FILES['avatar']['size'];
            $avatarTmp   = $_FILES['avatar']['tmp_name'];
            $avatarType   = $_FILES['avatar']['type'];
            // List of allowed file uploads
            $avatarextensions = array("jpeg", "jpg", "webp", "gif","png");
            
            $avatarExtension = explode('.', $avatarName);

            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $price      = $_POST['price'];
            $country    = $_POST['country'];
            $plate    = $_POST['plate'];
            $status     = $_POST['status'];
            $member     = $_POST['member'];
            $office     = $_POST['office'];
            $cat        = $_POST['category'];


            
            // Validate the Form 
            $formerrors = array();

            if(empty($name)){
                $formerrors[] ='Name must Not be <strong> Empty </strong>';
            }
            if(empty($desc)){
                $formerrors[] = ' Description  must not be <strong>Empty </strong>';
            }

            if(empty($price)){
                $formerrors[] = 'Price can not be <strong>empty</strong>';
            }
            if(empty($country)){
                $formerrors[] = 'Country can not be <strong>empty</strong>';
            }
            if($status == 0){
                $formerrors[] = 'You Must Choose a <strong>Status</strong>';
            }
            // if($member == 0){
            //     $formerrors[] = 'You Must Choose a <strong>Member</strong>';
            // }
            if($cat == 0){
                $formerrors[] = 'You Must Choose a <strong>Category</strong>';
            }
            if(empty($avatarName)){
                $formerrors[] = 'Image Can not be <strong>empty</strong>';
            }
            if($avatarsize > 4194304){
                $formerrors[] = 'Image Can Not be Larger Than  <strong>4 MB</strong>';
            }
            foreach($formerrors as $error){
                echo '<div class="alert alert-danger">' . $error .'<br/>';
            }
            // Check if there is no error do update for the data
            if(empty($formerrors)){
                        $avatar = rand(0, 100000) . '_' . $avatarName;
                        move_uploaded_file($avatarTmp, "Uploads\avatars\\".$avatar);

                        //Insert The data with the new information
                        $stmt = $con->prepare("INSERT INTO car
                        (Model, description, price, country_made,Plate_ID,status, date, cat_id, member ,office_id, avatar) 
                        Values
                        (:zmodel, :zdesc, :zprice, :zcountry, :zplate, :zstatus, now() , :zcategory, :zmember , :zoffice ,:zavatar)");
                        $stmt->execute(array(
                            'zmodel'             => $name,
                            'zdesc'              => $desc,
                            'zprice'             => $price,
                            'zcountry'           => $country,
                            'zplate'            => $plate,
                            'zstatus'            => $status,
                            'zcategory'            => $cat,
                            'zmember'            => $member,
                            'zoffice'            => $office,
                            'zavatar'            => $avatar

                        ));
                    $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . " Record Inserted Successfully!! </div>";
                    redirect($theMsg,'back',1);

            }
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
              $Car_ID = isset($_GET['Car_ID']) && is_numeric($_GET['Car_ID']) ? intval($_GET['Car_ID']) : 0;

              $stmt = $con->prepare("SELECT * FROM car WHERE Car_ID = ? LIMIT 1");
              $stmt->execute(array( $Car_ID));
              $row = $stmt->fetch();
              $count = $stmt->rowCount();
              //if There is such id fetch it 
              if($stmt->rowCount() > 0){ ?>
          <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
                <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa fa-tag"></i> Edit New Item --------------</h1>
                <div class="container">
                        <form class="form-horizontal" style="margin-bottom:10px" action="?do=Update" method="POST" >
                        <input type="hidden" name="itemid" value="<?php echo $Car_ID ?>" />
                        <!-- User Name field -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" placeholder="Name of the Item"  
                                    value="<?php echo $row['Model']?>"/>
                                </div>
                            </div>
                                        <!--For The description  -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Description</label>
                                <div class="col-sm-6">
                                    <input type="text" name="description" class="form-control" placeholder="Description of the Item"  
                                    value="<?php echo $row['description']?>" />
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Price</label>
                                <div class="col-sm-6">
                                    <input type="text" name="price" class="form-control" placeholder="Price of the Item"  
                                    value="<?php echo $row['price']?>"/>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Country Made</label>
                                <div class="col-sm-6">
                                    <input type="text" name="country" class="form-control" placeholder="Country of the Item"  
                                    value="<?php echo $row['country_made']?>"/>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Plate ID</label>
                                <div class="col-sm-6">
                                    <input type="text" name="plate" class="form-control" placeholder="Enter Plate ID" 
                                    value="<?php echo $row['Plate_ID']?>"/>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Image</label>
                                <div class="col-sm-6">
                                    <input type="file" name="avatar" class="form-control" 
                                    value="<?php echo $row['avatar']?>"/>
                                </div>
                            </div>
                            <!-- End Country Field -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Status</label>
                                <div class="col-sm-6">
                                    <select  name="status" style="height: 40px; width:476px" >
                                        <option value="1" <?php  if ($row['status'] == 1){  echo 'Selected' ;} ?>>New OR Sort One</option>
                                        <option value="2" <?php  if ($row['status'] == 2){  echo 'Selected' ;} ?>>Second Hand</option>
                                        <option value="3" <?php  if ($row['status'] == 3){  echo 'Selected' ;} ?>>Third Hand</option>
                                        <option value="4" <?php  if ($row['status'] == 4){  echo 'Selected' ;} ?>>Fourth Hand</option>

                                 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Members</label>
                                <div class="col-sm-6">
                                    <select  name="member" style="height: 40px; width:476px" >
                                      <?php 
                                      $stmt5 = $con->prepare("SELECT * FROM users WHERE stat = 'E'");
                                      $stmt5->execute();
                                      $user = $stmt5->fetchAll();
                                      foreach ($user as $user){
                                        echo "<option value='"  .$user['user_id']  . "'" ; 
                                        if($row['member'] == $user['user_id']){echo 'Selected ';}
                                        echo">".$user['user_name'] . "</option>";
                                      }
                                      ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Category</label>
                                <div class="col-sm-6">
                                    <select  name="category" style="height: 40px; width:476px" >
                                        <option value="0">.....</option>
                                      <?php 
                                      $stmt5 = $con->prepare("SELECT * FROM category");
                                      $stmt5->execute();
                                      $user = $stmt5->fetchAll();
                                      foreach ($user as $user){
                                        echo "<option value='"  .$user['category_id']  . "'";
                                        if($row['cat_id'] == $user['category_id']){echo 'Selected ';}
                                        echo ">".$user['category_name'] . "</option>";
                                      }
                                      ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Office</label>
                                <div class="col-sm-6">
                                    <select  name="office" style="height: 40px; width:476px" >
                                        <option value="0">.....</option>
                                      <?php 
                                    //   $stmt6 = $con->prepare("SELECT * FROM office JOIN users GROUP BY office_id");
                                    //   $stmt6->execute();
                                    //   $users = $stmt6->fetchAll();
                                    //   foreach ($users as $user){
                                    //     echo "<option value='"  .$user['office_id']  . "'";
                                    //     if($row['office_id'] == $user['office_id']){echo 'Selected ';}
                                    //     echo ">".$user['office_name'] . "</option>";
                                    //   }
                                      ?>
                                    </select>
                                </div>
                            </div> -->
                            <!-- For The Button -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" value="Edit Item" class="btn btn-warning btn-lg" style="font-family: cursive;" />
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
    
     }elseif($do == 'Update'){
        echo "<body style='background-image:url('Design/Images/5.jpg') ;background-size:cover' >";

        echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Update Item --------------</h1>';
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Get Variables from the form

            $id             = $_POST['itemid'];
            $name           = $_POST['name'];
            $desc           = $_POST['description'];
            $price          = $_POST['price'];
            $country        = $_POST['country'];
            $status         = $_POST['status'];
            $plate          = $_POST['plate'];
            $cat            = $_POST['category'];
            $member         = $_POST['member'];
            $avatar         = $_POST['avatar'];
            // $office         = $_POST['office'];

            
            $formerrors = array();

            if(empty($name)){
                $formerrors[] ='Name must Not be <strong> Empty </strong>';
            }
            if(empty($desc)){
                $formerrors[] = ' Description  must not be <strong>Empty </strong>';
            }

            if(empty($price)){
                $formerrors[] = 'Price can not be <strong>empty</strong>';
            }
            if(empty($country)){
                $formerrors[] = 'Country can not be <strong>empty</strong>';
            }
            if($status == 0){
                $formerrors[] = 'You Must Choose a <strong>Status</strong>';
            }
            if($member == 0){
                $formerrors[] = 'You Must Choose a <strong>Member</strong>';
            }
            if($cat == 0){
                $formerrors[] = 'You Must Choose a <strong>Category</strong>';
            }
            foreach($formerrors as $error){
                echo '<div class="alert alert-danger">' . $error .'<br/>';
            }
            // Check if there is no error do update for the data
            if(empty($formerrors)){
                            //Update The data with the new information
            $stmt = $con->prepare("UPDATE car SET Model = ?, description = ?, price = ?, country_made = ?, status = ?,Plate_ID = ?,
             cat_id = ?,member = ?, avatar = ?  WHERE Car_ID = ?");
            $stmt->execute(array($name, $desc, $price , $country, $status, $plate, $cat, $member, $avatar, $id));
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

                    echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Delete Item --------------</h1>';
                    echo "<div class='container'>";
                    $Car_ID = isset($_GET['Car_ID']) && is_numeric($_GET['Car_ID']) ? intval($_GET['Car_ID']) : 0;
                    $checkitem = check('Car_ID','car',$Car_ID); // is equal to select user_id from users where user_id = userid
                    
                    // if There is such id fetch it

                    if($checkitem > 0){ 
                        $stmt = $con->prepare("DELETE FROM car WHERE Car_ID = :zcarid");
                        $stmt->bindParam(':zcarid', $Car_ID);
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

        }elseif($do == 'Approve'){
            echo "<body style='background-image:url('Design/Images/5.jpg') ;background-size:cover' >";

            echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Approve Item --------------</h1>';
            echo "<div class='container'>";
            $Car_ID = isset($_GET['Car_ID']) && is_numeric($_GET['Car_ID']) ? intval($_GET['Car_ID']) : 0;

            $checkitem = check('Car_ID','car',$Car_ID); // is equal to select car_id from car where car_id = car_ID
            
            // if There is such id fetch it

            if($checkitem > 0){ 
                $stmt = $con->prepare("UPDATE car SET approve = 1 WHERE Car_ID = ?");
                $stmt->execute(array($Car_ID));

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


ob_end_flush(); //to print all output including The header
?>