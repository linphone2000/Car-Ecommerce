<?php session_start(); ?>
<html>

<head>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Labrada&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu&display=swap" rel="stylesheet">
    <!-- Boot Strap and CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header_footer.css">
</head>

<body>
    <nav id="navbar-example2" class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: #0e092e;">
        <a class="navbar-brand ms-3" href="clientpage.php">
            <img height="60px" src="../images/My Logo 2.png">
            <!-- <label><?php echo phpversion(); ?></label> -->
        </a>
        <button class="navbar-toggler ms-auto me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-3" id="navbarTogglerDemo01">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link hover-2 styled-link" href="#scrollspy1">Featured</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hover-2 styled-link" href="#scrollspy2">Store</a>
                </li>
            </ul>

            <ul style="margin-left: 25%;" class="navbar-nav">
                <li class="nav-item">
                    <?php
                    if (strpos($_SESSION['name'], "b2b") !== false) { ?>
                        <p style="margin-bottom: 0;color:white;font-size:1.5rem;" class="nav-link">Welcome Wholesale customer</p>
                    <?php }
                    ?>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto me-3">
                <li class="nav-item me-1"><a href="clientpage.php" class="nav-link hover-2 styled-link">Home</a></li>
                <li class="nav-item me-1"><a href="about.php" class="nav-link hover-2 styled-link">About</a></li>
                <li class="nav-item me-1"><a href="contact.php" class="nav-link hover-2 styled-link">Contact</a></li>
                <li class="nav-item me-1">
                    <div class="btn-group">
                        <?php if ($_SESSION['username'] == null) { ?>
                            <button class="profile-khalote" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <img width="30" src="https://cdn-icons-png.flaticon.com/512/8791/8791475.png">
                            </button>
                        <?php } ?>
                        <?php if (isset($_SESSION['username'])) { ?>
                            <button class="profile-khalote" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <img width="30" src="https://cdn-icons-png.flaticon.com/512/8791/8791434.png">
                            </button>
                        <?php } ?>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if ($_SESSION['username'] == null) { ?>
                                <li><a class="dropdown-item disabled">Not Logged in</a></li>
                                <hr style="margin:5%">
                                <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <?php } ?>
                            <?php if (isset($_SESSION['username'])) { ?>
                                <li><a class="dropdown-item disabled"><?php echo $_SESSION['name']; ?></a></li>
                                <hr style="margin:5%">
                                <li><a class="dropdown-item" href="userinfo.php">Account Information</a></li>
                                <li><a class="dropdown-item" href="order_information.php">Order Information</a></li>
                                <li><a class="dropdown-item" href="session_unset.php">Logout</a></li>
                            <?php } ?> <!-- End if -->
                        </ul>
                    </div>
                </li>
                <div class="ton_hlae">
                    <button id="navi-khalote" onclick="window.location.href='../client/mycart.php';">
                        <div class="noti-pone">
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $sameitem = array_column($_SESSION['cart'], "name");
                                foreach ($_SESSION['cart'] as $key => $val) {
                                    $total = $total + $val['quantity'];
                                }
                                if (in_array($_POST['name'], $sameitem)) {
                                }
                                echo $total;
                            }
                            ?>
                        </div>
                    </button>
                </div>
            </ul>
        </div>
    </nav>
    <!-- <script>
        $(".navbar-collapse").click(function () {
          $(".navbar-collapse").collapse("hide");
        });
    </script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
</body>

</html>