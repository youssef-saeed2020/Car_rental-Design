<?php
session_start();
$nonavbar = '';
$header = '';
$pagetitle = 'Signup';
// if you are already logged in the site will open without registration form
// if(isset($_SESSION['user_name'])){
//    header('Location: dashboard.php');
// }
include 'init.php';
// check if user coming fro HTTP request

   if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username   =$_POST['UserName'];
      $email      = $_POST['Email'];
      $password   = $_POST['PassWord'];
      $password2  = $_POST['ConfirmPassWord'];
      
      $formerrors = array();
      if(empty($username)){
         $formerrors[] = "Username must not be empty";

      }
      if(empty($formerrors)){
         $checkitem = check("user_name","users", $_POST['UserName']);
         if($checkitem == 1){
             $formerrors[] = "Sorry You Are Already exist";
             $failed = "Sorry You Are Already exist";
         } else {
            $stmt = $con->prepare("INSERT INTO users 
                                                (user_name, user_password, user_email, stat , user_date) 
                                          Values
                                                (:zuser, :zuser_password, :zuser_email, 'C', now() )");
                 $stmt->execute(array(
                     'zuser'             => $username,
                     'zuser_password'    => sha1($password),
                     'zuser_email'       => $email,
                 ));
                 $success = 'Congrats You are Now Added!';
               }
      }
      if(isset($failed)){
        echo "
        <script>alert('$failed' )</script>
      ";
      }elseif(isset($success)){
        echo "
        <script>alert('$success' )</script>
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
height: 50px;
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
    padding: 2px 0;
    background: transparent;
    transition: border-color 0.2s;
  
    &::placeholder {
      color: rgba(0, 0, 0, 0.75)
    }
  }
  
  
  
  .button {
    margin-top: 15px;
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
    width: 1.7em;
    margin: -0.2em 0.8em 1em;
    position: absolute;
    display: flex;
    transition: all 0.6s ease;
  }
  
  .button:hover svg {
    transform: translateX(5px);
  }
  
  .text {
    margin: 0 2.5em;
    font: 1.3em sans-serif;
  }
</style>
<body>
    
    <div class="background"></div>
    <div class="UnderWrapper" >
        <br><br><br><br><br><br><br><br><br>
    <h1 style="margin-inline-start: 550px; color:
     antiquewhite;  color: rgba(255, 255, 255, 0.75);
     font-size: 400%;"></h1>    
    </div>
    <div class="wrapper">
        <br><br><br><br>
        <a href="index.php" style="font-size: 30px; 
        color: black; text-decoration: none;
        margin-inline-start: 100px; font-size: 25px;">Login</a>

        <a href="signup.html" style="font-size: 30px; 
                color: black; text-decoration: none;
                margin-inline-start: 17.5px; font-size: 25px;">|</a>

        <a href="#"
        style="font-size: 30px;
        text-decoration: none;
        color: black;
        margin-inline-start: 17.5px;
        font-size: 25px;">Sign Up</a>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" target="_blank" onsubmit="return validate();">
            <br><br>
            
            <div class="input_box">
                <i class='bx bxs-user'></i>
                <input class="input_box2" type="text" name="UserName" placeholder="User Name " 
                style="font-size: 18px;"  required>
            </div>

            <div class="input_box">
                <i class='bx bxs-envelope'></i>
                <input class="input_box2" type="email" name="Email" placeholder="Email"
                 style="font-size: 18px;"  required>
            </div>

            <div class="input_box">
                <i class='bx bxs-lock-alt'></i>
                <input class="input_box2" type="password" name="PassWord"
                 placeholder="Password " required minlength="4" 
                 style="font-size: 18px;" 
                 id="PassWord" maxlength="10">
                <br><br>
            </div>
   
            <div class="input_box">
                <i class='bx bxs-lock-alt'></i>
                <input class="input_box2" type="password" name="ConfirmPassWord" 
                placeholder="Confirm Password " required minlength="4"
                style="font-size: 18px;" 
                id="ConfirmPassWord"   maxlength="10">
                <br><br>
            </div>

            <script>
                function validate() {
                    var password = document.getElementById("PassWord").value;
                    var confirm = document.getElementById("ConfirmPassWord").value;
                    if (password != confirm) {
                    alert("Password not Equal");
                    return false;
                    }
                }
            </script>

<br>
            <button class="button" >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                </svg>
                <div class="text">
                    SignUp
                </div>


        </form>

    </div>
</body>
<?php  include $tpl . 'footer.php';?>