<?php 
ob_start();
    session_start();
    $pagetitle = 'Categories';
    if(isset($_SESSION['user_name'])){
        include 'init.php';
        
        $do = ($_GET['do']) ? $_GET['do'] :'Manage';
        // start manage page
        if($do == 'Manage'){ 

            $sort = 'ASC';
            $sort_array = array('ASC','DESC');
            if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
                $sort = $_GET['sort'];
            }
            $stmt = $con->prepare("SELECT * FROM category ORDER BY ordering $sort");
            $stmt->execute();
    
            $rows = $stmt->fetchAll();
            ?>
<link rel="stylesheet" href="<?php echo $css; ?>Backend.css" />
    <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
         <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa fa-tag"></i>  Manage My Categories --------------</h1>
         <div class="container categories" >
            <div class="panel panel-default">
                <div class="panel-heading"> <i class='fa fa-tag'></i>  Manage Categories
                    <div class="option pull-right">
                        <i class="fa fa-sort"></i>
                        Ordering : [
                        <a class ="<?php if($sort == 'ASC'){ echo 'active'; } ?>"href="?sort=ASC">ASC</a> :
                        <a class ="<?php if($sort == 'DESC'){ echo 'active'; } ?>" href="?sort=DESC">DESC</a> ]
                        <i class="fa fa-eye"></i>
                        View :
                        <span class="active" style="cursor: pointer;color:orange">Full</span>
                        <span style="cursor: pointer;">Classic</span>
                    </div>
                </div>
                <div class="panel-body" style="padding: 0%;background-color:orange">
                    <?php 
                    foreach ($rows as $row){
                        echo "<div class='cat' style='padding:15px;position:relative;overflow:hidden'>";
                            echo "<div class='hidden-buttons'style='position:absolute;top:15px;right:10px;'>";
                                echo "<a href='category.php?do=Edit&catid=". $row['category_id'] . " ' class='btn btn-xs btn-primary' style='margin-right:5px;position:relative'><i class='fa fa-edit'></i> Edit</a>";
                                echo "<a href='category.php?do=Delete&catid=". $row['category_id'] . "' class='btn btn-xs btn-danger confirm' style='margin-right:5px;position:relative><i class='fa fa-close'></i> Delete</a>";
                                    echo "</div>";
                                    echo "<h3 style='margin:0;cursor: pointer;'>" .$row['category_name']. '</h3>';
                                    echo "<div class='full-view'>";
                                    echo "<p style='margin:10px 0px'>"; if($row['description'] == ''){echo 'This Category has no Description';}else{ echo $row['description']; }  echo "</p>";
                                    echo "<hr style='margin-top:0px;margin-bottom:0px'>";
                                    echo "</div>";
                        echo "</div>";
                    }
                    
                    ?>
                </div>
         </div>
         <a class="btn btn-warning" href="category.php?do=Add" style="margin-bottom: 30px;margin-top:-10px"><i class="fa fa-plus"></i> Add New Category</a>
    </div>
    </body>
        <?php
         } elseif($do == 'Add'){?>
            <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
                <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa fa-tag"></i> Add New Category --------------</h1>
                <div class="container">
                        <form class="form-horizontal" style="margin-bottom:10px" action="?do=Insert" method="POST">
                        <!-- User Name field -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name of the Category" autocomplete="off"  required ="required"/>
                                </div>
                            </div>
                            <!-- User description Field -->
                            <div class="form-group form-group-lg" style="margin-left:140px" >
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Description</label>
                                <div class="col-sm-6">
                                    <input type="text" name="description" class="form-control" placeholder="Enter Your Description"/>
                                </div>
                            </div>
                            <!-- user Email -->
                            <!-- <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Ordering</label>
                                <div class="col-sm-6">
                                    <input type="number" name="ordering" class="form-control" placeholder="Number To Arrange the Category" autocomplete="off"  />
                                </div>
                            </div> -->
                            <!-- Visibility Field -->
                            <!-- <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Visibility</label>
                                <div class="col-sm-6">
                                    <div >
                                        <input id="vis-yes" type="radio" name="visibility" value = '0' checked />
                                        <label for="vis-yes" style="color:white;font-size:20px">Yes</label>
                                    </div>
                                    <div >
                                        <input id="vis-no" type="radio" name="visibility" value = '1' />
                                        <label for="vis-no" style="color:white;font-size:20px">No</label>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Start Commenting -->
                            <!-- <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Allow Comment</label>
                                <div class="col-sm-6">
                                    <div >
                                        <input id="com-yes" type="radio" name="commenting" value = '0' checked />
                                        <label for="com-yes" style="color:white;font-size:20px">Yes</label>
                                    </div>
                                    <div >
                                        <input id="com-no" type="radio" name="commenting" value = '1'  />
                                        <label for="com-no" style="color:white;font-size:20px">No</label>
                                    </div>
                                </div>
                            </div> -->
                            <!-- End Allow commenting -->
                            <!-- start Allow Ads -->
                            <!-- <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Allow Ads</label>
                                <div class="col-sm-6">
                                    <div >
                                        <input id="ads-yes" type="radio" name="ads" value = '0' checked />
                                        <label for="ads-yes" style="color:white;font-size:20px">Yes</label>
                                    </div>
                                    <div >
                                        <input id="ads-no" type="radio" name="ads" value = '1'  />
                                        <label for="ads-no" style="color:white;font-size:20px">No</label>
                                    </div>
                                </div>
                            </div> -->
                            <!-- For The Button -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" value="Add Category" class="btn btn-warning btn-lg" style="font-family: cursive;" />
                                </div>
                            </div>
                        </form>
                </div>
            </body>
        <!-- Insert Category -->
        <?php }elseif($do == 'Insert'){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Insert Category --------------</h1>';
            echo "<div class='container'>";

            // Get Variables from the form
            $name           = $_POST['name'];
            $dec            = $_POST['description'];
            // $order          = $_POST['ordering'];
            // $visible        = $_POST['visibility'];
            // $com            = $_POST['commenting'];
            // $ads            = $_POST['ads']; 
            // check if the category is Exist in the database
                $checkitem = check("category_name","category", $name);

                if($checkitem == 1){
                    echo '<div class="container">';
                    $theMsg = "<div class='alert alert-danger'>Sorry This Category is Already <strong>exist</strong></div>";
                    redirect($theMsg,'back',1);
                    echo '</div>';
                } else {

                    //Insert The data with the new information
                    $stmt = $con->prepare("INSERT INTO category (category_name, description) 
                    Values(:zname, :zdec)");
                    $stmt->execute(array(
                        'zname'             => $name,
                        'zdec'              => $dec,
                        // 'zorder'            => $order,
                        // 'zvisible'          =>  $visible,
                        // 'zcom'              => $com,
                        // 'zads'              => $ads
                    ));
                $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . " Record Inserted Successfully!! </div>";
                redirect($theMsg,'back',1);

            }
            }else {
                echo '<div class="container">';
                $theMsg = '<div class="alert alert-danger"> Sorry you can not access this page</div>';
                redirect($theMsg,'back',1);
                echo '</div>';

            }
            echo "</div>";
            
            //End Insert page

        }elseif($do == 'Edit'){
            $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

            $stmt = $con->prepare("SELECT * FROM category WHERE category_id = ? ");
            $stmt->execute(array($catid));
            $cat = $stmt->fetch();
            $count = $stmt->rowCount();
            //if There is such id fetch it 
            if($stmt->rowCount() > 0){ ?>
            <body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
                <h1 class="text-center" style="color:orange; padding-top:40px; margin:50px 10px; font-family: cursive;">-------------- <i class="fa-solid fa-user"></i> Edit Category --------------</h1>
                <div class="container">
                        <form class="form-horizontal" style="margin-bottom:10px" action="?do=Update" method="POST">
                        <input type="hidden" name="catid" value="<?php echo $catid ?>" />

                        <!-- User Name field -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Category Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" placeholder="Name of The Category" value="<?php echo $cat['category_name'] ?>" required ="required"/>
                                </div>
                            </div>
                            <!-- User Password Field -->
                            <div class="form-group form-group-lg" style="margin-left:140px" >
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Description</label>
                                <div class="col-sm-6">
                                    <input type="text" name="description" class="form-control" placeholder="Enter Your Description" value="<?php echo $cat['description'] ?>"/>
                                </div>
                            </div>
                            <!-- user Email -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <label class="col-sm-2 control-label" style="color:orange; font-family: cursive;">Ordering</label>
                                <div class="col-sm-6">
                                    <input type="number" name="ordering" class="form-control" placeholder="Number To Arrange the Category" autocomplete="off" value="<?php echo $cat['ordering'] ?>" />
                                </div>
                            </div>
                            <!-- For The Button -->
                            <div class="form-group form-group-lg" style="margin-left:140px">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" value="Edit Category" class="btn btn-warning btn-lg" style="font-family: cursive;" />
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

        echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Update Category --------------</h1>';
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Get Variables from the form

                $id      = $_POST['catid'];
                $name    = $_POST['name'];
                $desc    = $_POST['description'];
                $order   = $_POST['ordering'];
                // $visible   = $_POST['visibility'];
                // $comment   = $_POST['commenting'];
                // $ad   = $_POST['ads'];


        //Update The data with the new information
            $stmt = $con->prepare("UPDATE 
                                        category 
                                    SET 
                                        category_name = ?, 
                                        description = ?, 
                                        ordering = ?
                                        -- visibility = ?, 
                                        -- allow_comment = ?, 
                                        -- allow_ads = ? 
                                    WHERE 
                                        category_id = ?");
            
            $stmt->execute(array($name, $desc,$order, $id));
            $theMsg ="<div class='alert alert-success'>" .$stmt->rowCount() . "Record Updated Successfully!! </div>";
            redirect($theMsg,'back',1); //Will redirect back to edit page
 
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

                echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Delete Category --------------</h1>';
                echo "<div class='container'>";
                    $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

                    $checkitem = check('category_id','category',$catid); // is equal to select user_id from users where user_id = userid
                    
                    // if There is such id fetch it

                    if($checkitem > 0){ 
                        $stmt = $con->prepare("DELETE FROM category WHERE category_id = :zcatid");
                        $stmt->bindParam(':zcatid', $catid);
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
        header('Location: index.php');
        exit();

}

ob_end_flush();

?>