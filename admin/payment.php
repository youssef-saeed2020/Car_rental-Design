<?php 
ob_start();
session_start();
$pagetitle = 'Payments';
if(isset($_SESSION['user_name'])){
    include 'init.php';
    $do = ($_GET['do']) ? $_GET['do'] :'Manage';
    // start manage page
    if($do == 'Manage'){ 
        // select all users except  admin
        // $query = '';
        // if(isset($_GET['page']) && $_GET['page'] == 'pending'){//for the activate for the pendding customers
        //     $query = 'AND approval = 0';
        // }

        $stmt = $con->prepare("SELECT * FROM reservation 
                                                join car 
                                                    ON car.car_id = reservation.car_id
                                                join office 
                                                    ON office.office_id = reservation.office_id ");
        $stmt->execute();

        $rows = $stmt->fetchAll();
        ?>
<body style="background-image:url('Design/Images/5.jpg') ;background-size:cover" >
     <h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- <i class="fa-solid fa-user-group"></i>  Manage Payments- --------------</h1>
     <div class="container" >
        <div class="table-responsive" style="background-color: aliceblue;">
            <table class="maintable text-center table table-bordered" style="box-shadow: 0 10px 20px #CCC">
                <tr style="background-color: orange;">
                    <td>#ID</td>
                    <td>Customer Name </td>
                    <td>Office Locattion</td>
                    <td>Manager Of The Office</td>
                    <td>Car Model</td>
                    <td>Price Of The Car</td>
                    <td>Start Renting</td>
                    <td>End Renting </td>
                    <td>Number Of Days </td>
                    <td>Total Price </td>
                    <td>Control</td>
                </tr>
                <?php 
                    foreach($rows as $row){
                        $todays_date = $row['start_rented_date']; 
                            $exp = $row['end_rented_date'];
                            $int = date_diff(date_create($todays_date), date_create($exp));
                            $price = $row['price'];
                            // result, Time difference in days.
                            $time = $int->format('%a');
                        echo '<td>' .$row['reserve_id'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['fullname']  . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['location'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['office_name'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['Model'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['price'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['start_rented_date'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$row['end_rented_date'] . '</td>';
                            echo '<td style="color:orange;font-size:20px">' .$time. '</td>';
                            echo '<td style="color:orange;font-size:20px">'.$time * $price . '</td>';
                            echo '<td>
                            <a href="payment.php?do=Delete&reserve_id='.$row['reserve_id']. ' "class="btn btn-danger confirm" style="padding:3px 10px;margin-left:5px"><i class="fa fa-close"></i> Delete </a>';
                            echo '</td>';
                        echo '</tr>';
                    }
                ?>
                <tr>
            </table>
        </div>

     </div>
</body>


<?php }elseif($do == 'Delete'){
        // Delete member page
                // fetch data from database to the edit form
                echo "<body style='background-image:url('Design/Images/9.jpg') ;background-size:cover' >";

                echo '<h1 class="text-center" style="color:orange; padding-top:20px; margin:40px 10px; font-family: cursive;">-------------- Delete Office --------------</h1>';
                echo "<div class='container'>";
                    $reserve_id = isset($_GET['reserve_id']) && is_numeric($_GET['reserve_id']) ? intval($_GET['reserve_id']) : 0;

                    $checkitem = check('reserve_id','reservation', $reserve_id); // is equal to select user_id from users where user_id = userid
                    
                    // if There is such id fetch it

                    if($checkitem > 0){ 
                        $stmt = $con->prepare("DELETE FROM reservation WHERE reserve_id = :zreserveid");
                        $stmt->bindParam(':zreserveid', $reserve_id);
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
        
    }elseif($do == 'search'){

    }
    include $tpl . 'footer.php';
    
}else{
    header('Location: index.php');
    exit();

}

ob_end_flush();
?>
