<?php 
    ob_start();
    session_start();
    $nonavbar = '';
    $pagetitle="View Item";

    include 'init.php';
    $Car_ID = isset($_GET['Car_ID']) && is_numeric($_GET['Car_ID']) ? intval($_GET['Car_ID']) : 0;

    $stmt = $con->prepare("SELECT 
                                car.*, category.category_name 
                            FROM
                                car
                            INNER JOIN
                                category ON car.cat_id = category.category_id

                            JOIN 
                              reservation
                                        ON reservation.car_id = car.car_id
                            JOIN 
                              office 
                                        ON reservation.office_id = office.office_id
                            WHERE
                                Car_ID = ?  ");

    if(isset($_POST["submit"])){
      $name             = $_POST['firstname'];
      $email            = $_POST['email'];
      $city             = $_POST['city'];
      $state            = $_POST['state'];
      $zip              = $_POST['zip']; 
      $cardname         = $_POST['cardname']; 
      $cardnumber       = $_POST['cardnumber']; 
      $start            = $_POST['start']; 
      $end              = $_POST['end']; 
      $car              = $_POST['car_id']; 
      $office            = $_POST['office_id'];
  

      $checkitem = check("car_id","reservation", $_POST['car_id']);

      if($checkitem == 1){
        echo "
        <script>alert('Sorry You Can not Rent This Car As  This Car ia Already Rented' )

        </script>
      ";
      }else{
      

      
      $stmt = $con->prepare("INSERT INTO reservation (fullname, email, city, state, zipcode , card_name, card_number , start_rented_date ,end_rented_date,car_id,office_id) 
      Values(:zname, :zemail, :zcity, :zstate, :zzip, :zcardname, :zcardnumber, :zstartrenteddate, :zendrenteddate, :zcarid , :zofficeid)");
      $stmt->execute(array(
          'zname'               => $name,
          'zemail'              => $email,
          'zcity'               =>  $city,
          'zstate'              => $state,
          'zzip'                => $zip,
          'zcardname'           => $cardname,
          'zcardnumber'         => $cardnumber,
          'zstartrenteddate'    => $start,
          'zendrenteddate'      =>  $end,
          'zcarid'              => $car,
          'zofficeid'          => $office
      ));

    $todays_date = $start; 

    $exp = $end;

    $int = date_diff(date_create($todays_date), date_create($exp));

    // result, Time difference in days.
    $time = "The Days of Renting is "." ".$int->format('%a'). ' Days';

      echo "
        <script>alert('Data Inserted Successfuly  $time' )

        </script>
      ";
  }
}
    ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type=date] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

<h2 class="text-center">Checkout Form</h2>
<p class="text-center">This is check out form please fill this form correctly and do not forget any number.</p>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname" required><i class="fa fa-user"></i> Full Name</label>
            <input type="text" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" name="zip" placeholder="10001">
              </div>
              <div class="col-50">
                                <label class="col-sm-2 control-label" >Choose Your Near Office</label>
                                <div class="col-sm-6">
                                    <select  name="office_id" style="height: 40px; width:300px" >
                                        <option value="0">.....</option>
                                      <?php 
                                      $stmt5 = $con->prepare("SELECT * FROM office join car on car.office_id = office.office_id");
                                      $stmt5->execute();
                                      $user = $stmt5->fetchAll();
                                      foreach ($user as $user){
                                        echo "<option value='"  . $user['office_id']  . "'>".$user['location'] . "</option>";
                                      }
                                      ?>
                                    </select>
                                </div>
                            </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Start Rented Date</label>
            <input type="date"  name="start" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">End Rented Date</label>
                <input type="date"  name="end" placeholder="2018">
              </div>
            </div>
            <div class="row">
              <div class="col-50">
                <!-- <label for="expyear">Your Car</label> -->
                <input type="hidden" name="car_id" placeholder="2018" value="<?php echo $Car_ID ?> ">
              </div>
            </div>
          </div>
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <button type="submit" name="submit" class="btn">Confirm My checkout</button>
      </form>
    </div>
  </div>

  <div class="col-25">
    <div class="container">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>
        <?php 
           $stmt5 = $con->prepare("SELECT * FROM car WHERE car_id = $Car_ID");
           $stmt5->execute();
           $stat = $stmt5->fetch();
        ?>

1
      </b></span></h4>
      <p><a href="item.php?Car_ID=<?php echo $Car_ID; ?>"><?php echo $stat['Model'] ?> </a> <span class="price"><?php echo $stat['price'] ?></span></p>
      <hr>
      <p> <span class="price" style="color:black"><b><?php echo $stat['price'] ?></b></span></p>
    </div>
  </div>
</div>

</body>
</html>

<?php
include $tpl . 'footer.php';
?>