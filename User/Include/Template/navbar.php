<div class="upper-bar" style="background-color:#EEE">
            <div class="container">
              <?php
              // if you are already logged in the site will open without registration form
              if(isset($_SESSION['user_name'])){ ?>
              <img class="img-thumbnail img-circle pull-right" src="design/Images/1.webp" alt="" 
              style="width:35px;height:32px;" />
              <div class="btn-group pull-right">
                <span class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user_name'] ?>
                <span class="cart"></span>
                </span>
                <ul class="dropdown-menu " >
                  <li><a href="profile.php">My Profile</a></li>
                  <li><a href="logout.php">Logout</a></li>
                  <li><a href="categories.php?pageid=1&pagename=Cars">Browse</a></li>
              </ul>
              </div>
      <?php 
                 echo 'Welcome ' . $_SESSION['user_name'] .' ';
                 if(getuserstatus($_SESSION['user_name']) == 0){
                    
                 }

              }else{
8
              ?>
                <!-- <a href="signup.php">
                    <span class="pull-right" style="padding-left: 8px;"><i class="fa-solid fa-user-plus"></i>  SignUp</span>
                    </a>
                    <a href="index.php">
                    <span class="pull-right"><i class="fa-solid fa-right-to-bracket"></i>  Login</span>
                </a> -->
                <?php } ?>
            </div>
        </div>
<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:#e5e5e5e5;">
  <div class="container">
     
    <a class="navbar-brand" href="#" style="position:relative;right: 90px;color:Black;font-size:30px;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><i class="fa-solid fa-car-side fa-beat fa-lg" style="margin-right: 15px;color:orange"></i> <span style="color:orange">AC</span>celerate Auto
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav navbar-right " >
          <?php 
          foreach(getcat() as $cat){
            echo 
            '<li><a href="categories.php?pageid='. $cat['category_id'] .  '&pagename=' . str_replace(' ','-',$cat['category_name']) .'">'  .   $cat['category_name']   .  
            '</a></li>';
        }
  
          ?>
      </ul>
    </div>
    <form class="d-flex pull-right" role="search" style="position:relative;left:80px" method="POST">
        <input class="form-control me-2" name="search"  placeholder="Search" aria-label="Search" type="text" >
        <button class="btn btn-outline-success" name="submit" type="text"><a href="search.php" style="text-decoration:none">Search</a></button>
      </form>

  </div>
</nav>