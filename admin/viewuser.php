<?php
include "connection.php";
?>
<!DOCTYPE html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
<title>View User</title>
<link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
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
</style>
</head>
<body>
<header><?php include 'admin_header.php' ?></header>    
<div class="mybox">
    <div class="table-responsive">
        <table class="table table-light text-center mb-0">
            <tr class=" table-primary">
              <th>Customer ID</th>
              <th>Name</th> 
              <th>Email</th>
              <th>Payment</th>
              <th>Address</th>
              <th>Address 2</th>
              <th>City</th>
              <th>State</th>
              <th>Zip</th>
              <th>Card Number</th>
              <th colspan="12">
                <form class="d-flex text-center" method="POST" action="../admin/viewuser.php" role="search">
                    <input name="searchText" class="form-control me-2" type="search" placeholder="Search by customer" aria-label="Search">
                    <button name="searchButton" class="btn btn-outline-primary" type="submit">Search</button>
                </form>
              </th>
        </tr>
        <?php
        if($_POST['searchText']==null ){
            $sql = "SELECT * FROM customer";
            $sq = $db->prepare($sql);
            $sq ->execute();
            while($row=$sq->fetch(PDO::FETCH_ASSOC)){
                extract($row);?>
                <tr>
                    <td><?php echo $cid;?></td>
                    <td><?php echo $cname;?></td>
                    <td><?php echo $cemail;?></td>
                    <td><?php echo $cpayment;?></td>
                    <td><?php echo $caddress1;?></td>
                    <td><?php echo $caddress2;?></td>
                    <td><?php echo $ccity;?></td>
                    <td><?php echo $cstate;?></td>
                    <td><?php echo $czip;?></td>
                    <td><?php echo $ccardnumber;?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a data-bs-toggle="tooltip" data-bs-title="View Customer's Order"><button class="btn btn-outline-primary my-3" onclick="window.location.href='checkuserorder.php?userid=<?php echo $cid; ?>';"><i class="bi bi-eye-fill"></i></button></a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a data-bs-toggle="tooltip" data-bs-title="Delete"><button class="btn btn-outline-danger my-3" onclick="window.location.href='deleteuser.php?deleteid=<?php echo $cid; ?>';"><i class="bi bi-x-lg"></button></a></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php
            }
        }elseif(isset($_POST['searchText'])){
            $searchName = $_POST['searchText'];
            // $sql = "SELECT * FROM item WHERE name LIKE '%$searchName%' OR description LIKE '%$searchName%'";
            $sql = "SELECT * FROM customer WHERE cname LIKE '%$searchName%'";
            $sq = $db->prepare($sql);
            $sq ->execute();
            while($row=$sq->fetch(PDO::FETCH_ASSOC)){
                extract($row);?>
                <tr>
                    <td><?php echo $cid;?></td>
                    <td><?php echo $cname;?></td>
                    <td><?php echo $cemail;?></td>
                    <td><?php echo $cpayment;?></td>
                    <td><?php echo $caddress1;?></td>
                    <td><?php echo $caddress2;?></td>
                    <td><?php echo $ccity;?></td>
                    <td><?php echo $cstate;?></td>
                    <td><?php echo $czip;?></td>
                    <td><?php echo $ccardnumber;?></td>
                    <td><a data-bs-toggle="tooltip" data-bs-title="Delete"><button class="btn btn-outline-danger my-3" onclick="window.location.href='deleteuser.php?deleteid=<?php echo $cid; ?>';"><i class="bi bi-x-lg"></button></a></td>
                    <td><a data-bs-toggle="tooltip" data-bs-title="View Customer's Order"><button class="btn btn-outline-primary my-3" onclick="window.location.href='checkuserorder.php?userid=<?php echo $cid; ?>';"><i class="bi bi-eye-fill"></i></button></a></td>
                </tr>
            <?php
            }
        }
        ?>
        </table>
    </div>
</div>
<div class="text-center">
    <form method="GET" action="../admin/viewuser.php#">
            <input class="button_style me-2" type="button" value="Back" onclick="window.location.href='dashboard_user.php';">
            <button class="button_style" type="submit" name="clearfilter">Clear Filter</button>
    </form>
    <?php 
        if(isset($_GET['clearfilter'])){
            $_GET['catname'] = null;
        }
    ?>
</div>
<footer style="position:relative;margin-top: 12.5%;"><?php include 'admin_footer.php'; ?></footer>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</body>
</html>