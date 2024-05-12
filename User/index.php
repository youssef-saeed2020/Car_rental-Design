<?php
session_start();
$nonavbar = '';
$pagetitle = 'Login';
// if you are already logged in the site will open without registration form
// if you are already logged in the site will open without registration form
// if(isset($_SESSION['user_name'])){
//    header('Location: ../admin/dashboard.php');
// }
include 'init.php';
// check if user coming fro HTTP request

   if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username =$_POST['user'];
      $password = $_POST['pass'];
      $hashedPass = sha1($password);
   //   Check if the user in the database

      $stmt = $con->prepare("SELECT user_id, user_name, user_password FROM users WHERE user_name = ? AND user_password = ?
      AND stat = 'A'  LIMIT 1");
      $stmt->execute(array($username, $hashedPass));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();

      $stmt1 = $con->prepare("SELECT user_id, user_name, user_password FROM users WHERE user_name = ? AND user_password = ?
      AND stat = 'C' LIMIT 1");
      $stmt1->execute(array($username, $hashedPass));
      $row = $stmt1->fetch();
      $count1 = $stmt1->rowCount();

      // Check if count  is greater than zero
      if($count > 0) {
         $_SESSION['user_name'] = $username;
         $_SESSION['ID'] = $row['user_id'];//register session id
         header('Location: ../admin/dashboard.php');
         exit();

      }elseif($count1 > 0 ){
          $_SESSION['user_name'] = $username;
          $_SESSION['ID'] = $row['user_id'];//register session id
         header('Location: categories.php?pageid=1&pagename=Cars');
         exit();


      }else{
        echo "
        <script>alert('Sorry You Are Not In the System Signup First' )

        </script>
      ";
      }

      }
   
      
?>
<style>
body {
  height: 100%;
  width: 100%;
  margin: 0;
  padding: 0;
}

.background {
  height: 741px;
  width: 100%;
  background-image: url("design/Images/5.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: top;
  background-clip: border-box;
  opacity: .5;
}

.UnderWrapper{
  
  width: 800px;
  height: 500px;
  background-image: url("design/Images/5.jpg");
background-size: 100%;
background-position-y:-70px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 12px;

}

 .wrapper {
  
  width: 390px;
  height: 500px;
  position: absolute;
  top: 50%;
  left: 33.1%;
  transform: translate(-38.25%, -50%);
  backdrop-filter: blur(2px) saturate(500%);
  -webkit-backdrop-filter: blur(16px) saturate(1%);
  background-color: rgba(255, 255, 255, 0.44);
  border-radius: 12px;
  border: 1px solid rgba(209, 213, 219, 0.3);
}


.input_box {
font-size: 15px;
margin-top: 10px;
width: 220px;
margin-inline-start: 82px;
}

.input_box2 {
  font-family: inherit;
  width: 100%;
  border: 0;
  border-bottom: 2px solid black;
  outline: 0;
  font-size: 1.3rem;
  color: black;
  padding: 7px 0;
  background: transparent;
  transition: border-color 0.2s;

  &::placeholder {
    color: rgba(0, 0, 0, 0.75)
  }
}



.button {
margin-top: 20px;
margin-inline-start:92px;
background-color: black;
  color: #fff;
  width: 195px;
  height: 2.4em;
  border: black 0.2em solid;
  border-radius: 11px;
  text-align: right;
  transition: all 0.6s ease;
}

.button:hover {
  background-color: black;
  cursor: pointer;
}

.button svg {
  width: 1.6em;
  margin: -0.2em 0.8em 1em;
  position: absolute;
  display: flex;
  transition: all 0.6s ease;
}

.button:hover svg {
  transform: translateX(5px);
}

.text {
  margin: 0 3.2em;
  font: 1.3em sans-serif;
}

</style>
 <body>
        <div class="background"></div>

        <div class="UnderWrapper" >
            <br><br><br><br><br><br><br><br><br>
        <h1 style="margin-inline-start: 550px;
        margin-top: -160px;
        vertical-align: 50px;
        color:antiquewhite;  color: rgba(255, 255, 255, 0.75);
        font-size: 400%;"></h1>
        </div>
        <div class="wrapper" >
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <br><br><br><br>

                <a href="#" style="font-size: 30px; 
                color: black; text-decoration: none;
                margin-inline-start: 100px; font-size: 25px;">Login</a>

                <a href="login.html" style="font-size: 30px; 
                color: black; text-decoration: none;
                margin-inline-start: 17.5px; font-size: 25px;">|</a>

                <a href="signup.php"
                style="font-size: 30px;
                text-decoration: none;
                color: black;
                margin-inline-start: 17.5px;
                font-size: 25px;">Sign Up</a>
                <div class="input_box">
                    <br><br>
                    <i class='bx bxs-user'></i>
                    <input class="input_box2" type="text" name="user"
                     placeholder="User Name "
                     style="font-size: 18px;" required>
                     <br><br>
                </div>
                
                <div class="input_box">
                    <i class='bx bxs-lock-alt'></i>
                    <input class="input_box2" type="password" name="pass"
                     placeholder="Password " style="font-size: 18px;" required >
                     <br><br>
                </div>

                <div class="Register" style="margin-inline-start: 50px;">
                            <!-- <a href="RegestraionPahe.html">Are You New?</a> -->
                        </label>
                </div>
                <br><br>
                <button class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                    </svg>
                    <div class="text">
                      Login
                    </div>
                  
                  </button>
            </form>

        </div>

<?php  include $tpl . 'footer.php';?>