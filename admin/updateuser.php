<?php 
include '../admin/connection.php';
$cid = $_GET['cid'];
$sql1 = "SELECT * FROM customer WHERE cid='$cid'";
$sq1 = $db->prepare($sql1);
$sq1 ->execute();
$row=$sq1->fetch(PDO::FETCH_ASSOC);
extract($row);
?>
<html>
<head>
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
        margin: auto;
        transition: .5s;
        width: 50%;
    }
    .mybox:hover{
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
    </style>
    <title>User Information</title>
    <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
</head>
<body>
<header><?php include '../admin/admin_header.php'; ?></header>
    <div class="mybox my-5 py-3 text-center">
        <form class="login" action="../admin/updateuserprocess.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="cid" value="<?php echo $cid ?>">
            <h2 style="color: #544ab3;" class="mb-4">Your Information</h2>
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <fieldset disabled>
                    <input class="form-control" value="<?php echo $cid ?>" type="text" id="cid" name="cid" required>
                    </fieldset>
                </div>    
            </div>
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $cname ?>" type="text" id="cname" name="cname" placeholder="Enter name" required>
                </div>
            </div>    
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $cemail ?>" type="text" id="cemail" name="cemail" placeholder="Enter email" required>
                </div>
            </div>    
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <select name="cpayment" id="registerState" class="form-select mb-4">
                      <option selected><?php echo $cpayment; ?></option>
                      <option>Cash</option>
                      <option>Mobile Banking</option>
                      <option>E-Wallet</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $caddress1 ?>" type="text" id="caddress1" name="caddress1" placeholder="Enter Address 1" required>
                </div>
            </div>    
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $caddress2 ?>" type="text" id="caddress2" name="caddress2" placeholder="Enter Address 2 (Optional)">
                </div>
            </div>    
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $ccity ?>" type="text" id="ccity" name="ccity" placeholder="Enter City">
                </div>
            </div>    
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <select name="cstate" id="cstate" class="form-select">
                      <option selected><?php echo $cstate; ?></option>
                      <option>Ayeyarwady</option><option>Bago</option><option>Chin</option>
                      <option>Kachin</option><option>Kayah</option><option>Kayin</option>
                      <option>Magway</option><option>Mandalay</option><option>Mon</option>
                      <option>Rakhine</option><option>Sagaing</option><option>Shan</option>
                      <option>Tanintharyi</option><option>Yangon</option>
                    </select> 
                </div>
            </div>   
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $czip ?>" type="text" id="czip" name="czip" placeholder="Enter ZIP code" required>
                </div>
            </div>    
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $ccardnumber; ?>" type="text" id="ccardnumber" name="ccardnumber" placeholder="Enter Card Number">
                </div>
            </div>    
            <br>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input class="button_style" type="submit" value="Update" onclick="window.location.href='../admin/updateuserprocess.php';">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input class="button_style" type="button" value="Back" onclick="window.location.href='../admin/viewuser.php';">
                </div>
            </div>

        </form>
    </div>
<footer><?php include '../admin/admin_footer.php'; ?></footer>
<script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>