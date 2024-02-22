<?php
    include '../admin/connection.php';
    $itemid = $_GET['iid'];
    $sql = "SELECT * FROM moredata WHERE iid=$itemid";
    $sq = $db->prepare($sql);
    $sq ->execute();
    $row = $sq->fetch(PDO::FETCH_ASSOC);
    extract($row);

    $sql2 = "SELECT name FROM item WHERE iid=$itemid ";
    $sq2 = $db->prepare($sql2);
    $sq2 ->execute();
    $row2 = $sq2->fetch(PDO::FETCH_ASSOC);
    extract($row2);
?>
<html>
<head>
    <!-- Title -->
    <title>Update Item Details</title>
    <!-- Icon -->
    <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Style -->
    <style>
        .button_style1{
            margin: 15px 5px;
            background: #fff;
            font-size: .7rem;
            border-radius: 26px;
            border: 1px solid #D4D3E8;
            text-transform: uppercase;
            font-weight: 700;
            align-items: center;
            width: 140px;
            height: 50px;
            color: #544bb3;
            box-shadow: 0px 2px 2px #544bb3;
            cursor: pointer;
            transition: .2s;
            position: relative;
        }
        .button_style1:active,
        .button_style1:focus,
        .button_style1:hover {
            border-color: #3b25b3;
            background-color: #3b25b3;
            color: white;
            outline: none;
        }
        #toadditem{
            text-align: center;
            padding: 5% 5%;
        }
        .myform{
            margin: auto;
            padding: 2%;
            border-radius: 2%;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            transition: .5s;
            width: 50%;
        }
        .myform:hover{
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
    </style>
</head>
<body>
    <header><?php include '../admin/admin_header.php'; ?></header>

    <section id="toadditem">
        <form class="myform" action="../admin/updateitemdetails_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="itemid" value="<?php echo $itemid?>">
            <input type="hidden" name="mid" value="<?php echo $mid?>">
            <!-- Item ID -->
            <div class="row mb-3">
                <div class="col-lg-3">
                    
                </div>
                <div class="col-lg-6">
                    <fieldset disabled>
                        <input class="form-control" value="<?php echo $name ?>" type="text" name="iid" required>
                    </fieldset>
                </div>
                <div class="col-lg-3">
                    
                </div>
            </div>
            <!-- Detail 6 -->
            <div class="row mb-3">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <input class="form-control" type="text" name="detail6" value="<?php echo $detail6 ?>" placeholder="Brand" required>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <!-- Detail 1 -->
            <div class="row mb-3">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <input class="form-control" type="text" name="detail1" value="<?php echo $detail1 ?>" placeholder="Fuel Type" required>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <!-- Detail 2 -->
            <div class="row mb-3">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <input class="form-control" type="text" name="detail2" value="<?php echo $detail2 ?>" placeholder="Engine" required>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <!-- Detail 3 -->
            <div class="row mb-3">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <input class="form-control" type="text" name="detail3" value="<?php echo $detail3 ?>" placeholder="Horse Power" required>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <!-- Detail 4 -->
            <div class="row mb-3">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <input class="form-control" type="text" name="detail4" value="<?php echo $detail4 ?>" placeholder="Year Produced" required>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <!-- Detail 5 -->
            <div class="row mb-3">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <input class="form-control" type="text" name="detail5" value="<?php echo $detail5 ?>" placeholder="Rating" required>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <!-- Photo Section -->
            <input type="hidden" name="mphoto1" value="<?php echo $mphoto1 ?>">
            <input type="hidden" name="mphoto2" value="<?php echo $mphoto2 ?>">
            <input type="hidden" name="mphoto3" value="<?php echo $mphoto3 ?>">
            
            <div class="col-md-12">
                    <input class="button_style1" type="submit" value="Confirm">
            </div>
        </form>
    </section>
        

    <footer style="position:relative;margin-top:auto;"><?php include '../admin/admin_footer.php' ?></footer>
    <!-- <script src="../bootstrap/js/bootstrap.min.js"></script> -->
</body>
</html>