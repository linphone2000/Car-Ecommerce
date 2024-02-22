<?php
include "connection.php";
$sql = "SELECT * FROM moredata";
$sq = $db->prepare($sql);
$sq ->execute();
?>
<!DOCTYPE html>
<head>
<title>View Item Details</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
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
            <tr><th style="background-color: #cfe1fe;" colspan="10" class="text-center text-white">Items</th></tr>
            <tr class="text-center table-primary">
              <th>Name</th>
              <th>Brand</th>
              <th>Fuel Type</th> 
              <th>Engine</th>
              <th>Horse Power</th>
              <th>Year Produced</th>
              <th>Rating</th>
              <th>Sample</th>
              <th></th>
              <th></th>
        </tr>
        <?php
        while($row=$sq->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $itemid = $iid;
            $sql2 = "SELECT name FROM item WHERE iid=$itemid";
            $sq2 = $db->prepare($sql2);
            $sq2 ->execute();
            $row2 = $sq2->fetch(PDO::FETCH_ASSOC);
            extract($row2);
            ?>
            <tr>
                <td><?php echo $name;?></td>
                <td><?php echo $detail6;?></td>
                <td><?php echo $detail1;?></td>
                <td><?php echo $detail2;?></td>
                <td><?php echo $detail3;?></td>
                <td><?php echo $detail4;?></td>
                <td><?php echo $detail5;?></td>
                <td><img src="../images/<?php echo $mphoto1;?>" alt="image" height="60"></td>
                <td><a data-bs-toggle="tooltip" data-bs-title="Edit Item Details"><button class="btn btn-outline-success mt-3" onclick="window.location.href='updateitemdetails.php?iid=<?php echo $iid; ?>';"><i class="bi bi-sliders"></i></button></a></td>
                <td><a data-bs-toggle="tooltip" data-bs-title="Delete"><button class="btn btn-outline-danger mt-3" onclick="window.location.href='deleteitemdetails.php?did=<?php echo $iid; ?>';"><i class="bi bi-x-lg"></i></button></a></td>
            </tr>
        <?php
        }
        ?>
        </table>
    </div>
</div>
<div class="text-center mb-4">
    <input class="button_style" type="button" value="Back" onclick="window.location.href='dashboard_item.php';">
</div>
<footer style="padding-top:%"><?php include 'admin_footer.php'; ?></footer>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</body>
</html>