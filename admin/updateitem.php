
<?php
    include 'connection.php';
    $iid = $_GET['iid'];
    $sql = $db->prepare("SELECT * FROM item WHERE iid=$iid");
    $sql->execute();
    $row=$sql->fetch(PDO::FETCH_ASSOC);
    extract($row);
?>
<!DOCTYPE html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
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
        width: 160px;
        outline: none;
    }
    .mybox{
        border-radius: 2%;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        margin: auto 25% auto 25%;
        transition: .5s;
    }
    .mybox:hover{
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
    h2{
        font-family: 'Roboto', sans-serif;
    }
</style>
</head>
<body>
<header><?php include 'admin_header.php' ?></header>    
<div class="mybox">
    <div class="container text-center pt-5 pb-5 mt-5 mb-5">
        <form class="login" action="../admin/updateprocess.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="iid" value="<?php echo $iid ?>">
            <h2 style="color: #544ab3;" class="mb-4">EDIT ITEM</h2>
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $name ?>" type="text" id="name" name="name" placeholder="Enter name" required>
                </div>    
            </div>
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $category ?>" type="text" id="category" name="category" placeholder="Enter category" required>
                </div>
            </div>    
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $price ?>" type="text" id="price" name="price" placeholder="Enter price" required>
                </div>
            </div>    
            <br>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <input class="form-control" value="<?php echo $description ?>" type="text" id="description" name="description" placeholder="Enter description" required>
                </div> 
            </div>    
            <br>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div>
                        <img width="50%" src = "../images/<?php echo $image ?>">
                    </div>
                    <input type="hidden" name="oldimg" value="<?php echo $image ?>">
                    <div>
                        <input id="selectedFile" type="file" name="img" style="display: none;">
                        <input class="button_style" type="button" name="newimg" value="Choose File" onclick="document.getElementById('selectedFile').click();" />
                        <!-- <input class="login__submit" type="file" name="newimg"> -->
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input class="button_style" type="submit" value="Update" onclick="window.location.href='../admin/updateprocess.php';">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input class="button_style" type="button" value="Back" onclick="window.location.href='../admin/viewitem.php';">
                </div>
            </div>

        </form>
    </div>
</div>
<footer style="position:relative;margin-top:auto;"><?php include 'admin_footer.php'; ?></footer>
</body>
</html>