<?php
    session_start();
    include '../admin/connection.php';
    $itemid = $_GET['detailsid'];
    $sql = $db->prepare("SELECT * FROM moredata WHERE iid=$itemid");
    $sql->execute();
    $row=$sql->fetch(PDO::FETCH_ASSOC);
    extract($row);

    $sql1 = $db->prepare("SELECT * FROM item WHERE iid=$itemid");
    $sql1 ->execute();
    $row1=$sql1->fetch(PDO::FETCH_ASSOC);
    extract($row1);
    // echo $detail5;
?>
<html>
<head>
    <title>More Info</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        /* Carousel */
        .img-in-carousel{
            width: 45%;
        }
        .carousel-inner{
            height: 60%;
            padding-top: 5%;
        }
        .carousel-item{
            text-align: center;
        }
        .row{
            width: 100%;
        }
        /* Details */
        .mybox{
            width: 99%;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            border-radius: 10px;
            margin: auto;
            padding: 5% 5%;
            transition: .3s;
        }
        .mybox:hover{
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        .img-in-mybox{
            width: 25%;
        }
        .myp{
            margin: 5% 0 1%;
            font-family: 'Montserrat', sans-serif;
        }
        .carhead{
            font-family: 'Roboto Slab', serif;
            font-weight: 700;
        }
        /* Form */
        .button_style{
            margin-bottom: 15px;
	        background: #fff;
            font-size: 14px;
            border-radius: 26px;
            border: 1px solid #D4D3E8;
            text-transform: uppercase;
            font-weight: 700;
            align-items: center;
            width: 150px;
            height: 50px;
            color: #544bb3;
            box-shadow: 0px 2px 2px #544bb3;
            cursor: pointer;
            transition: .2s;
            position: relative;
        }
        .button_style:active,
        .button_style:focus,
        .button_style:hover {
	        border-color: #3b25b3;
            background-color: #3b25b3;
            color: white;
	        width: 160px;
	        outline: none;
        }
    </style>
</head>
<body>
    <header><?php include '../client/header.php'?></header>

    <!-- Photobox -->
    <section id="photobox">
        <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="true">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active " data-bs-interval="4000">
                <img src="../images/<?php echo $mphoto1 ?>" class="img-in-carousel">
              </div>
              <div class="carousel-item" data-bs-interval="4000">
                <img src="../images/<?php echo $mphoto2 ?>" class="img-in-carousel">
              </div>
              <div class="carousel-item" data-bs-interval="4000">
                <img src="../images/<?php echo $mphoto3 ?>" class="img-in-carousel">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Specification -->
    <section id="specs">
        <div class="row m-0">
            <?php
                $sql2 = $db->prepare("SELECT name FROM item where iid=$itemid");
                $sql2->execute();
                $row2=$sql2->fetch(PDO::FETCH_ASSOC);
                extract($row2);
            ?>
            <h1 class="text-center mb-5 carhead"><?php echo $name;?></h1>
        </div>
        <div class="row px-5 m-0 text-center">
            <div class="col-lg-4 mb-5"><div class="mybox"><h3 class="mb-2 carhead">Fuel</h3><img class="img-in-mybox" src="https://cdn-icons-png.flaticon.com/512/9249/9249819.png"><p class="myp"><?php echo $detail1 ?></p></div></div>
            <div class="col-lg-4 mb-5"><div class="mybox"><h3 class="mb-2 carhead">Engine</h3><img class="img-in-mybox" src="https://cdn-icons-png.flaticon.com/512/9593/9593378.png"><p class="myp"><?php echo $detail2 ?></p></div></div>
            <div class="col-lg-4 mb-5"><div class="mybox"><h3 class="mb-2 carhead">Horse Power</h3><img class="img-in-mybox" src="https://cdn-icons-png.flaticon.com/512/9249/9249793.png"><p class="myp"><?php echo $detail3 ?></p></div></div>
        </div>
        <div class="row px-5 m-0 text-center">
            <div class="col-lg-4 mb-5"><div class="mybox"><h3 class="mb-2 carhead">Model</h3><img class="img-in-mybox" src="https://cdn-icons-png.flaticon.com/512/9124/9124022.png"><p class="myp"><?php echo $detail4 ?></p></div></div>
            <div class="col-lg-4 mb-5"><div class="mybox"><h3 class="mb-2 carhead">Rating</h3><img class="img-in-mybox" src="https://cdn-icons-png.flaticon.com/512/10037/10037926.png"><p class="myp"><?php echo $detail5 ?></p></div></div>
            <div class="col-lg-4 mb-5"><div class="mybox"><h3 class="mb-2 carhead">Factory</h3><img class="img-in-mybox" src="https://cdn-icons-png.flaticon.com/512/9649/9649704.png"><p class="myp"><?php echo $detail6 ?></p></div></div>
        </div>
    </section>
    <form class="text-center" method="POST" action="managecart.php">
        <input type="hidden" name="iid" value="<?php echo $iid ?>">
        <input type="hidden" name="image" value="<?php echo $image ?>">
        <input type="hidden" id="name" name="name" value="<?php echo $name?>">
        <input type="hidden" id="price" name="price" value="<?php echo $price?>">
        <input type="hidden" id="description" name="description" value="<?php echo $description?>">
        <button class="button_style" name="buy" onclick="window.location.href='../client/managecart.php';">
            Add to Cart
        </button>
    </form>

    <footer><?php include '../client/footer.php'?></footer>
<script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>