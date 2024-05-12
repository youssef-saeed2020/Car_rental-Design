<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:#e5e5e5e5;">
  <div class="container">
     
    <a class="navbar-brand" href="index.html" style="padding-right: 20px;color:Black;font-size:30px;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><i class="fa-solid fa-car-side fa-beat fa-lg" style="margin-right: 15px;color:orange"></i> <span style="color:orange">A</span>ccelerate Auto
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" style="padding: 18px 15px;color:orange;font-size:20px" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="padding: 18px 15px;color:orange;font-size:20px" aria-current="page" href="category.php?do=Manage"><?php echo lang('CATEGORIES')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="padding: 18px 15px;color:orange;font-size:20px" aria-current="page" href="items.php?do=Manage" ><?php echo lang('ITEMS')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="padding: 18px 15px;color:orange;font-size:20px" aria-current="page" href="members.php?do=Manage"><?php echo lang('MEMBERS')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="padding: 18px 15px;color:orange;font-size:20px" aria-current="page" href="payment.php?do=Manage"><?php echo lang('Payments')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="padding: 18px 15px;color:orange;font-size:20px" aria-current="page" href="office.php?do=Manage"><?php echo lang('OFFICE')?></a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link active" style="padding: 18px 15px;color:orange;font-size:20px" aria-current="page" href="#"></a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="padding: 18px 15px; text-decoration: none; color:orange;font-size:20px" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Youssef
          </a>
          <ul class="dropdown-menu" style="background-color:orange; width:200px; padding: 10px 15px; font-size: 1em; border: none; ">
            <li><a class="dropdown-item" href="members.php?do=Edit&userid=12345"><i class="fa-regular fa-pen-to-square" style="position:relative;left:-5px;color:gray;"></i> Edit My Profile</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear" style="position:relative;left:-5px;color:gray;"></i>Settings</a></li>
            <li><a class="dropdown-item" href="../User/categories.php?pageid=1&pagename=Cars"><i class="fa-solid fa-gear" style="position:relative;left:-5px;color:gray;"></i>View Site</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket" style="position:relative;left:-5px;color:gray;"></i>
              Logout</a></li>
          </ul>
        </li>

      </ul>
      <!-- <form class="d-flex" role="search" style="padding: 9px 25px; position:relative" >
        <input class="form-control me-18" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-warning"style="color:black" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>