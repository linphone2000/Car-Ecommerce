<!-- Normal Statement -->
<?php
    include '../admin/connection.php';
    session_start();
?>

<html>
<head>
    <title>Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Labrada&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <style>
        .button_style{
            top: 0px;
            margin-top: 5px;
            margin-bottom: 15px;
	        background: #fff;
            font-size: 14px;
            border-radius: 26px;
            border: 1px solid #D4D3E8;
            text-transform: uppercase;
            font-weight: 700;
            align-items: center;
            top: 10px;
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
        .p-style{
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 5px;
        }
        .ttext-center{
            /* ECF2FF */
            text-align: center;
            /* background-color: #ecfaff; */
            border-radius: 10px;
            padding-top: 15px;
            padding-bottom: 15px;
            margin: 15px auto 15px auto;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
            transition: .5s;
        }
        .ttext-center:hover{
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }
        .ttd{
            padding-left: 10px;
            padding-right: 10px;
            transition: 0.2s;
        }
        .ttd:hover{
            background-color: #ecf2ff;
            outline:none;
        }
        .nt{
            position: relative;
            height: 100%;
            top: 0%;
        }
        .bg-photo-container{
            text-align: center;
            display: inline-block;
            width: 100%;
            background: rgb(4,16,138);
            background: linear-gradient(0deg, rgba(4,16,138,1) 0%, rgba(14,9,46,1) 100%);
        }
        .adver{
            font-family: 'Montserrat', sans-serif;
            color: white;
            font-size: 1.5rem;
            text-align: left;
            line-height: 2.5;
            margin: 2% 5% auto 5%;
        }
        .gaung-sin{
            /* position: relative; */
            font-family: 'Montserrat', sans-serif;
            margin-top: 1%;
            color: white;
        }
        .photo-of-car{
            top: 25%;
            left: 0%;
            /* position: relative; */
            width: 90%;
        }
        .atann{
            margin: 25px auto 15px auto;
            border-style: dotted none none none;
            border-width: 10px;
            border-color: black;
            width: 60%;
        }
        .carousel-inner{
            height: 88%;
            padding-top: 1%;
        }
        .carow{
            margin-left: 0;
            width: 100%;
            margin-top: 5%;
            text-align: center;
        }
        /* Features */
        .f-section{
            padding: 5% 0 0;
        }
        .f-image{
            width: 40%;
        }
        .f-text{
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 1.25rem;
            margin-top: 5%;
        }
        /* Download */
        .d-section{
            font-family: 'Montserrat', sans-serif;
            padding: 5.5% 25% 0.5%;
            text-align: center;
            background-color: #0e092e;
        }
        .d-text{
            font-weight:bold;
            color: white;
        }
        .download-button{
            margin: 25px 10px 0px;
        }
        .d-image{
            margin-top: 50px; 
            border-style: solid;
            border-color:#0e092e;
            border-radius: 10px;
            transition: .2s;
        }
        .d-image:hover{
            border-style: solid;
            border-color: #1C84C4;
        }
        /* Search */
        #search-and-filter{
            width: 100%;
            height: 100px;
        }
        .searchBox {
            position: absolute;
            /* top: 50%; */
            left: 50%;
            transform:  translate(-50%,50%);
            background: #2f3640;
            /* height: 40px; */
            border-radius: 40px;
            padding: 10px;

        }

        .searchBox:hover > .searchInput {
            width: 240px;
            padding: 0 6px;
        }

        .searchBox:hover > .searchButton {
          background: white;
          color : #2f3640;
        }

        .searchButton {
            color: white;
            float: right;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #2f3640;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.4s;
        }

        .searchInput {
            border:none;
            background: none;
            outline:none;
            float:left;
            padding: 0;
            color: white;
            font-size: 16px;
            transition: 0.4s;
            line-height: 40px;
            width: 0px;
        
        }
        .mydropdown{
            background-color: #0e092e;
        }
        /* Phone */
        @media (max-width: 500px) {
            .carousel-inner{
                height: 72%;
                padding: 0% 2.5%;
            }
            .adver{
                font-size: 1.36rem;
                margin: 2% 5% auto 5%;
                text-align: center;
            }
            .d-image{
                margin-top: 20px;
            }
            .searchButton {
                color: white;
                float: right;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #2f3640;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: 0.4s;
            }
            .searchBox{
                width: 150px;
                padding: 0 6px;
                width: 150px;
                padding: 0 6px;
                display: flex;
                align-items: center;
                justify-content: flex-end;
            }
            .searchBox:hover > .searchInput {
                width: 75px;
                padding: 0 6px;
            }
        }
        /* Not Important */
        @media (min-width: 510px) and (max-width: 730px){
            .carousel-inner{
                height: 70%;
            }
        }
        /* Tablet */
        @media (min-width: 730px) and (max-width: 800px){
            .carousel-inner{
                height: 45%;
            }
            .adver{
                font-size: 1.15rem;
                text-align: center;
            }
            .photo-of-car{
                padding-top: 10%;
            }
            .searchButton {
                color: white;
                float: right;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #2f3640;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: 0.4s;
            }
            .searchBox{
                width: 150px;
                padding: 0 6px;
                width: 150px;
                padding: 0 6px;
                display: flex;
                align-items: center;
                justify-content: flex-end;
            }
            .searchBox:hover > .searchInput {
                width: 75px;
                padding: 0 6px;
            }
        }
    </style>
</head>
<body style="background-color: #f8f9fa;" id="scrollspy1">
<!-- Header -->
<?php 
    include 'header_for_scroll.php';
?>
<div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example rounded-2" tabindex="0">
<!-- Carousel -->
<div class="bg-photo-container">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="true">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="4000">
            <h1 class="gaung-sin">An unmatched blend of power and soul</h1>
            <div class="row" style="width: 100%;margin: 5% 0 0;padding:0% 5%;">
                <div class="col-md-8 p-0">
                    <img class="photo-of-car" src="../images/Nissan-GT-R-PNG-Transparent.png">
                </div>
                <div class="col-md-4 p-0">
                    <p class="adver">
                        A singular supercar, so intuitive it can be enjoyed by drivers of all levels. So capable it can be driven in a wide variety of conditions.
                    </p>
                </div>
            </div>
        </div>
        <div class="carousel-item"  data-bs-interval="4000">
                <h1 class="gaung-sin">Take it further in the K5</h1>
                <div class="row" style="width: 100%;margin: 5% 0 0;padding:0% 5%;">
                    <div class="col-md-8 p-0">
                        <img class="photo-of-car" src="../images/kia k5 2.png">
                    </div>
                    <div class="col-md-4 p-0">
                        <p class="adver">
                            With capable performance features and a driver-centric interior, the K5 GT is built for those who expect the most and accept nothing less.
                        </p>
                    </div>
                </div>
        </div>
        <div class="carousel-item" data-bs-interval="4000">
                <h1 class="gaung-sin">Fashion leans further forward</h1>
                <div class="row" style="width: 100%;margin: 5% 0 0;padding:0% 5%;">
                    <div class="col-md-8 p-0">
                        <img class="photo-of-car" src="../images/Mercedes-Benz-CLA-Class-removebg.png">
                    </div>
                    <div class="col-md-4 p-0">
                        <p class="adver">
                        It's the ongoing advancement of a passionate original. Its four-door coupe style whispers seductively in your ear.
                        </p>
                    </div>
                </div>
        </div>
      </div>
      <button style="width: 50px;" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button style="width: 50px;" class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
</div>
<!-- Features -->
<section class="f-section text-center">
    <div class="row w-100">
        <div class="col-lg-4 col-md-12">
            <img class="f-image" src="https://cdn-icons-png.flaticon.com/512/9005/9005545.png">
            <p class="f-text">Best Price</p>
        </div>
        <div class="col-lg-4 col-md-12">
            <img class="f-image" src="https://cdn-icons-png.flaticon.com/512/6168/6168305.png">
            <p class="f-text">Wide Variety</p>
        </div>
        <div class="col-lg-4 col-md-12">
            <img class="f-image" src="https://cdn-icons-png.flaticon.com/512/5465/5465743.png">
            <p class="f-text">Trust Worthy</p>
        </div>
    </div>
</section>

<hr id="scrollspy2" class="atann">

<!-- Search & Filter-->
<form class="mb-0" method="POST" action="../client/clientpage.php#scrollspy1">
    <?php 
        $catsql = "SELECT DISTINCT category FROM item";
        $catsq = $db->prepare($catsql);
        $catsq ->execute();?>
        <div class="dropdown mt-3 text-center">
        <button class="btn btn-lg btn-outline-dark dropdown-toggle mydropdown mx-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Filter
        </button>
        <button class="btn btn-lg btn-outline-dark mx-1" type="button" name="clearfilter" onclick="window.location.href='../client/clientpage.php';">Clear Filter</button>
        <?php 
        if(isset($_GET['clearfilter'])){
            $_Get['catname'] = null;
        } 
        ?>
        <ul class="dropdown-menu dropdown-menu-dark">
        <?php while($catrow=$catsq->fetch(PDO::FETCH_ASSOC)){
            extract($catrow); ?>
          <li><a class="dropdown-item" onclick="window.location.href='clientpage.php?catname=<?php echo $category; ?>';"><?php echo $category?></a></li>
        <?php } ?>
          <li></li>
        </ul>
        </div>
</form>
<form method="POST" action="../client/clientpage.php#searchresult">
    <div id="search-and-filter">    
        <div class="searchBox">
            <input class="searchInput"type="text" name="search" placeholder="Search">
                <button class="searchButton" name="searchbutton" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
        </div>
    </div>
</form>

<!-- Store -->
<?php if($_GET['catname']==null){ ?>
<?php
    $sql = "SELECT * FROM item";
    $sq = $db->prepare($sql);
    $sq ->execute();
?>
<div class="container-fluid mt-3 px-5 pb-5">
  <div class="row">
  <?php
    while ($row=$sq-> fetch(PDO::FETCH_ASSOC)){
        extract($row);
    ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div  class="ttext-center">
            <form class="m-0" method="POST" action="../client/managecart.php">
                
                <input type="hidden" name="iid" value="<?php echo $iid ?>">

                <img src="../images/<?php echo $image;?>" alt="image"  height="100">
                <input type="hidden" name="image" value="<?php echo $image ?>">

                <p class="p-style"><?php echo "Name: ".$name;?></p>
                <input type="hidden" id="name" name="name" value="<?php echo $name?>">

                <p class="p-style"><?php echo "Price: ".'$'.$price;?></p>
                <input type="hidden" id="price" name="price" value="<?php echo $price?>">

                <p class="p-style"><?php echo "Brand: ".$description;?></p>
                <input type="hidden" id="description" name="description" value="<?php echo $description?>">

                <button class="button_style" name="buy" onclick="window.location.href='../client/managecart.php';">
                        Add to Cart
                </button>
                <br>
            </form>
            <input type="hidden" id="textarea" name="textarea" value="<?php echo $name?>">
            <button type="button" class="button_style" onclick="window.location.href='itemdetails.php?detailsid=<?php echo $iid; ?>';">
                More Info
            </button>
        </div>
    </div>
    <?php   
        }
?>
  </div>
</div>
<?php }
else if(isset($_GET['catname'])){
    $categotyname = $_GET['catname'];
    $sql = $db->prepare("SELECT * FROM item WHERE category LIKE '$categotyname'");
    $sql->execute();?>
    <div class="container-fluid mt-3 px-5 pb-5">
        <div class="row">
            <?php while ($row=$sql-> fetch(PDO::FETCH_ASSOC)){
                extract($row);
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div  class="ttext-center">
                    <form class="m-0" method="POST" action="../client/managecart.php">

                        <input type="hidden" name="iid" value="<?php echo $iid ?>">
            
                        <img src="../images/<?php echo $image;?>" alt="image"  height="100">
                        <input type="hidden" name="image" value="<?php echo $image ?>">
            
                        <p class="p-style"><?php echo "Name: ".$name;?></p>
                        <input type="hidden" id="name" name="name" value="<?php echo $name?>">
            
                        <p class="p-style"><?php echo "Price: ".'$'.$price;?></p>
                        <input type="hidden" id="price" name="price" value="<?php echo $price?>">
            
                        <p class="p-style"><?php echo "Category: ".$category;?></p>
                        <input type="hidden" id="description" name="description" value="<?php echo $description?>">
            
                        <button class="button_style" name="buy" onclick="window.location.href='../client/managecart.php';">
                                Add to Cart
                        </button>
                        <br>
                    </form>
                    <input type="hidden" id="textarea" name="textarea" value="<?php echo $name?>">
                    <button type="button" class="button_style" onclick="window.location.href='itemdetails.php?detailsid=<?php echo $iid; ?>';">
                        More Info
                    </button>
                </div>
            </div>
            <?php   
                } ?>
        </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- Store Search -->
<?php
    if(isset($_POST['searchbutton'])){
        if(isset($_POST['search'])){
            $name = $_POST['search'];
            $searchstatement = $db->prepare("SELECT * FROM item WHERE name LIKE '%$name' or description like '%$name'");
            $searchstatement->execute(); ?>
        <div id="searchresult" class="container-fluid mt-3 px-5 pb-5">
            <div class="row">
                <h2 class="text-center">Result for "<?php echo $name ?>"</h2>
            <?php
            while($answer=$searchstatement->fetch(PDO::FETCH_ASSOC)){
                extract($answer); ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div  class="ttext-center">
                        <form class="m-0" method="POST" action="../client/managecart.php">

                            <input type="hidden" name="iid" value="<?php echo $iid ?>">

                            <img src="../images/<?php echo $image;?>" alt="image"  height="100">
                            <input type="hidden" name="image" value="<?php echo $image ?>">

                            <p class="p-style"><?php echo "Name: ".$name;?></p>
                            <input type="hidden" id="name" name="name" value="<?php echo $name?>">

                            <p class="p-style"><?php echo "Price: ".'$'.$price;?></p>
                            <input type="hidden" id="price" name="price" value="<?php echo $price?>">

                            <p class="p-style"><?php echo "Brand: ".$description;?></p>
                            <input type="hidden" id="description" name="description" value="<?php echo $description?>">

                            <button class="button_style" name="buy" onclick="window.location.href='../client/managecart.php';">
                                    Add to Cart
                            </button>
                            <br>
                        </form>
                        <input type="hidden" id="textarea" name="textarea" value="<?php echo $name?>">
                        <button type="button" class="button_style" onclick="window.location.href='itemdetails.php?detailsid=<?php echo $iid; ?>';">
                            More Info
                        </button>
                    </div>
                </div>
        <?php   } ?>
            </div>
            <div class="text-center">
                <button type="button" class="button_style" name="clearbutton" onclick="window.location.href='../client/clientpage.php';">
                Clear
                </button>
            </div>
            <?php
            if(isset($_GET['clearbutton'])){
                $_POST['search'] == null;
            }
            ?>
        </div>
        <?php }
        else{
            echo "Nothing Found!";
        }
    }
?>

<!-- Download -->
<section class="d-section">
    <h3 class="d-text">Find The Dream Ride of Your Life Today.</h3>
    <button class="btn btn-dark btn-lg download-button" type="button"><i class="fa-brands fa-apple"></i> Download</button>
    <button class="btn btn-outline-light btn-lg download-button" type="button"><i class="fa-brands fa-google-play"></i> Download</button>
    <br><a href="#scrollspy1"><img class="d-image" width="75" src="../images/255-2557792_up-arrow-top-image-png-white-removebg-preview.png"></a>
</section>
</div>
<div>
<!-- Footer -->
<?php include 'footer.php'; ?>
</div>
<script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
