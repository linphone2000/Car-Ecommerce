<?php
include "connection.php";
?>
<!DOCTYPE html>
<head>
<title>Order Information</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .button_style{
        top: 0px;
        margin-top: 15px;
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
        outline: none;
    }
    .mybox{
        /* box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; */
        /* margin: 3% 5% 0%; */
        transition: .5s;
    }
    /* .mybox:hover{
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    } */
    h2{
        font-family: 'Roboto', sans-serif;
    }
    h1{
        font-family: 'Roboto', sans-serif;
    }
    .mydropdown{
        background-color: #0e092e;
    }
</style>
</head>
<body>
<header><?php include 'admin_header.php' ?></header>  
<div style=" background-color: #cfe1fe;padding: 0.5% 0%;">
<!-- Filter -->
<form class="mb-0" method="POST" action="../admin/vieworder.php">
    <?php 
        $catsql = "SELECT DISTINCT cname FROM customer";
        $catsq = $db->prepare($catsql);
        $catsq ->execute();?>
        <div class="dropdown text-center">
        <button class="btn btn-outline-primary dropdown-toggle mydropdown mx-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Filter by Name
        </button>
        <form method="GET" action="../admin/vieworder.php#">
        <button class="btn btn-outline-primary mx-1" type="submit" name="clearfilter">Clear Filter</button>
        </form>
        <?php 
        if(isset($_GET['clearfilter'])){
            $_GET['catname'] = null;
        } 
        ?>
        <ul class="dropdown-menu dropdown-menu-dark">
        <?php while($catrow=$catsq->fetch(PDO::FETCH_ASSOC)){
            extract($catrow); ?>
          <li><a class="dropdown-item" onclick="window.location.href='vieworder.php?catname=<?php echo $cname; ?>';"><?php echo $cname?></a></li>
        <?php } ?>
          <li></li>
        </ul>
        </div>
</form> 
<!-- Search -->
<div class="container-fluid w-25 text-center">
    <form class="d-flex text-center mt-3" method="POST" action="../admin/vieworder.php" role="search">
        <input name="searchText" class="form-control me-2" type="search" placeholder="Search by customer name" aria-label="Search">
        <button name="searchButton" class="btn btn-outline-primary" type="submit">Search</button>
    </form>
</div>
</div>
<div class="mybox">
    <div class="table-responsive">
        <table class="table table-light text-center mb-0">
            <tr><th style="background-color: #cfe1fe;" colspan="7" class="text-center text-white"></th></tr>
            <tr class="text-center table-primary">
              <th>Order ID</th>
              <th>Customer Name</th> 
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Date</th>
              <th></th>
        </tr>
        <?php
        if($_GET['catname']==null and $_POST['searchText']==null ){
            $sql = "SELECT * FROM myorder";
            $sq = $db->prepare($sql);
            $sq ->execute();
            while($row=$sq->fetch(PDO::FETCH_ASSOC)){
                extract($row);?>
                <tr>
                    <td><?php echo $oid;?></td>
                    <td>
                        <?php
                        $sql2 = "SELECT * FROM customer WHERE cid=$cid"; 
                        $sq2 = $db->prepare($sql2);
                        $sq2 ->execute();
                        $row2 = $sq2->fetch(PDO::FETCH_ASSOC);
                        extract($row2);
                        echo $cname;
                        ?>
                    </td>
                    <td><?php echo $oname;?></td>
                    <td><?php echo $quantity;?></td>
                    <td><?php echo '$'.$price;?></td>
                    <td><?php echo $date;?></td>
                    <td><a data-bs-toggle="tooltip" data-bs-title="Delete"><button class="btn btn-outline-danger mt-1" onclick="window.location.href='deleteorder.php?did=<?php echo $oid; ?>';"><i class="bi bi-x-lg"></i></button></a></td>
                </tr>
            <?php
            }
        }else if(isset($_GET['catname'])){
            $nameToUse = $_GET['catname'];
            $sql2 = "SELECT * FROM customer WHERE cname='$nameToUse'"; 
            $sq2 = $db->prepare($sql2);
            $sq2 ->execute();
            $row2 = $sq2->fetch(PDO::FETCH_ASSOC);
            extract($row2);
            $sql = "SELECT * FROM myorder WHERE cid=$cid";
            $sq = $db->prepare($sql);
            $sq ->execute();
            while($row=$sq->fetch(PDO::FETCH_ASSOC)){
                extract($row);?>
                <tr>
                    <td><?php echo $oid;?></td>
                    <td>
                        <?php
                        echo $cname;
                        ?>
                    </td>
                    <td><?php echo $oname;?></td>
                    <td><?php echo $quantity;?></td>
                    <td><?php echo '$'.$price;?></td>
                    <td><?php echo $date;?></td>
                    <td><a data-bs-toggle="tooltip" data-bs-title="Delete"><button class="btn btn-outline-danger mt-1" onclick="window.location.href='deleteorder.php?did=<?php echo $oid; ?>';"><i class="bi bi-x-lg"></i></button></a></td>
                </tr>
            <?php
            }
        }
        else if(isset($_POST['searchText'])){
                $searchName = $_POST['searchText'];
                $sql2 = "SELECT * FROM customer WHERE cname LIKE '%$searchName%'"; 
                $sq2 = $db->prepare($sql2);
                $sq2 ->execute();
                while($row2 = $sq2->fetch(PDO::FETCH_ASSOC)):
                extract($row2);
                $sql = "SELECT * FROM myorder WHERE cid=$cid";
                $sq = $db->prepare($sql);
                $sq ->execute();
                while($row=$sq->fetch(PDO::FETCH_ASSOC)){
                    extract($row);?>
                    <tr>
                        <td><?php echo $oid;?></td>
                        <td>
                            <?php
                            echo $cname;
                            ?>
                        </td>
                        <td><?php echo $oname;?></td>
                        <td><?php echo $quantity;?></td>
                        <td><?php echo '$'.$price;?></td>
                        <td><?php echo $date;?></td>
                        <td><a data-bs-toggle="tooltip" data-bs-title="Delete"><button class="btn btn-outline-danger mt-1" onclick="window.location.href='deleteorder.php?did=<?php echo $oid; ?>';"><i class="bi bi-x-lg"></i></button></a></td>
                    </tr>
                <?php
                } endwhile;
        }
        ?>
        </table>
    </div>
</div>
<div class="text-center mb-4">
    <input class="button_style" type="button" value="Back" onclick="window.location.href='dashboard_order.php';">
</div>
<footer style="position:relative;margin-top:12.5%;"><?php include 'admin_footer.php'; ?></footer>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</body>
</html>