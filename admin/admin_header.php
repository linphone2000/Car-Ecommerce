<?php
  session_start();
  if($_SESSION['adminname']==null){
    echo"<script>alert('Please Log in!');window.location.href = '../admin/adminlogin.php';</script>";
  }
?>
<html>
<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin_header_css.css">
</head>
<body>
    <nav class="navbar sticky-top w-100 px-2" data-bs-theme="dark" style="background-color: #202c70;">
    <a class="navbar-brand" href="dashboard.php"><img height="60px" src="../images/My Logo 2.png"></a>
      <!-- <div class="container-fluid"> -->
        <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item me-1">
                <div class="btn-group">
                <?php if($_SESSION['adminname']==null){ ?>
                    <a class="my_a" href="../admin/adminlogin.php">Login</a>
                <?php } ?> 
                <?php if(isset($_SESSION['adminname'])){ ?>
                    <a class="my_a" href="../admin/adminlogout.php">Logout</a>
                <?php } ?> 
                </div>
                </li>
        </ul>
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div style="background-color: #202c70;" class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><a href="dashboard.php"><img height="60px" src="../images/My Logo 2.png"></a></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="dashboard.php">HOME</a>
                <hr>
                <!-- <li class="nav-item dropdown"> -->
                  <!-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ITEM MENU
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="dashboard_item.php">ITEM DASHBOARD</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="additem.php">ADD ITEM</a></li>
                    <li><a class="dropdown-item" href="viewitem.php">VIEW ITEM</a></li>
                    <li><a class="dropdown-item" href="viewitem.php">UPDATE ITEM</a></li>
                    <li><a class="dropdown-item" href="viewitem.php">DELETE ITEM</a></li>
                  </ul>

                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    CUSTOMER MENU
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="dashboard_user.php">CUSTOMER DASHBOARD</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="viewuser.php">VIEW CUSTOMER</a></li>
                    <li><a class="dropdown-item" href="viewuser.php">CHECK CUSTOMER'S ORDERS</a></li>
                    <li><a class="dropdown-item" href="viewuser.php">DELETE CUSTOMER</a></li>
                  </ul>

                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ORDER MENU
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="dashboard_order.php">ORDER DASHBOARD</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="vieworder.php">VIEW ORDER</a></li>
                    <li><a class="dropdown-item" href="vieworder.php">DELETE ORDER</a></li>
                  </ul> -->
                  <!-- Accordion -->
                  <div class="accordion" id="accordionExample">
                    <!-- One -->
                    <div style="border: none;" class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button style="background-color: #1f2c70;padding-left:0;color:white;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          ITEM MENU
                        </button>
                      </h2>
                      <div id="collapseOne" style="background-color: #1f2c70;" class="accordion-collapse collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <ul class="mylist">
                          <li class="myli"><a class="link-in-accordion" href="dashboard_item.php">ITEM DASHBOARD</a></li>
                          <li class="myli"><hr class="my-divider"></li>
                          <li class="myli"><a class="link-in-accordion" href="additem.php">ADD ITEM</a></li>
                          <li class="myli"><a class="link-in-accordion" href="viewitem.php">VIEW ITEM</a></li>
                          <li class="myli"><a class="link-in-accordion" href="viewitem.php">UPDATE ITEM</a></li>
                          <li class="myli"><a class="link-in-accordion" href="viewitem.php">DELETE ITEM</a></li>
                          <hr class="my-divider">
                          <li class="myli"><a class="link-in-accordion" href="viewitemdetails.php">VIEW ITEM DETAILS</a></li>
                        </ul>
                        </div>
                      </div>
                    </div>
                    <!-- Two -->
                    <div style="border: none;" class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button style="background-color: #1f2c70;padding-left:0;color:white;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                          CUSTOMER MENU
                        </button>
                      </h2>
                      <div id="collapseTwo" style="background-color: #1f2c70;" class="accordion-collapse collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <ul class="mylist">
                          <li class="myli"><a class="link-in-accordion" href="dashboard_user.php">CUSTOMER DASHBOARD</a></li>
                          <li class="myli"><hr class="my-divider"></li>
                          <li class="myli"><a class="link-in-accordion" href="viewuser.php">VIEW CUSTOMER</a></li>
                          <li class="myli"><a class="link-in-accordion" href="viewuser.php">CHECK CUSTOMER'S ORDERS</a></li>
                          <li class="myli"><a class="link-in-accordion" href="viewuser.php">DELETE ORDER</a></li>
                        </ul>
                        </div>
                      </div>
                    </div>
                    <!-- Three -->
                    <div style="border: none;" class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button style="background-color: #1f2c70;padding-left:0;color:white;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
                          ORDER MENU
                        </button>
                      </h2>
                      <div id="collapseThree" style="background-color: #1f2c70;" class="accordion-collapse collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <ul class="mylist">
                          <li class="myli"><a class="link-in-accordion" href="dashboard_order.php">ORDER DASHBOARD</a></li>
                          <li class="myli"><hr class="my-divider"></li>
                          <li class="myli"><a class="link-in-accordion" href="vieworder.php">VIEW ORDER</a></li>
                          <li class="myli"><a class="link-in-accordion" href="vieworder.php">DELETE ORDER</a></li>
                        </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Accordion -->
                <!-- </li> -->
              </li>
            </ul>
          </div>
        </div>
      <!-- </div> -->
    </nav>
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>