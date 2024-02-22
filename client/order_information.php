<?php 
include '../admin/connection.php';
session_start();
$nametouse = $_SESSION['username'];
$sql1 = "SELECT * FROM customer WHERE cemail='$nametouse'";
$sq1 = $db->prepare($sql1);
$sq1 ->execute();
$row=$sq1->fetch(PDO::FETCH_ASSOC);
extract($row);

$sql2 = "SELECT * FROM myorder WHERE cid=$cid";
$sq2 = $db->prepare($sql2);
$sq2 ->execute();
// $row2 = $sq2->fetch(PDO::FETCH_ASSOC);
// extract($row2);

// echo $oid;
// echo $cid;
?>
<html>
<head>
<link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
<title>Ordered Items</title>
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
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        margin: 30% auto;
        transition: .5s;
        width: 85%;
        padding-left: 10%;
        padding-right: 10%;
    }
    .mybox:hover{
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
    </style>
</head>
<body>
<header><?php include '../client/header.php'; ?></header>
<div style="margin-top: 5%;">
    <div class="mybox my-5 py-3 text-center">
            <h2 style="color: #544ab3;" class="mb-4">Your Ordered Items</h2>
            <table class="table table-hover text-center">
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Date</th>
                </tr>
            <?php
            while($row2 = $sq2->fetch(PDO::FETCH_ASSOC)){
            extract($row2);
            ?>
            <tr style="margin-bottom: 5%;">
            <td><?php echo $oname ?></td>
            <td><?php echo $quantity ?></td>
            <td><?php echo "$".$price ?></td>
            <td><?php echo $date ?></td>
            </tr>    
            <?php
            $whole_quantity = $whole_quantity+$quantity;
            $whole_total = $whole_total+$price;
            }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td><?php echo "Total Quantity: ".$whole_quantity ?></td>
                <td><?php echo "Total Price: $".$whole_total ?></td>
            </tr>
            </table>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input class="button_style" type="button" value="Back" onclick="window.location.href='../client/clientpage.php';">
                </div>
            </div>
    </div>
</div>
<footer style="margin-top: 25%;"><?php include '../client/footer.php'; ?></footer>
<script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>