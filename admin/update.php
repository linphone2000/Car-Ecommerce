<?php
    include 'connection.php';
    $iid = $_GET['iid'];
    $sql = $db->prepare("SELECT * FROM item WHERE iid=$iid");
    $sql->execute();
    $row=$sql->fetch(PDO::FETCH_ASSOC);
    extract($row);
?>
<!DOCTYPE html>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
<link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
<link rel="stylesheet" href="../css/update.css">
<body>
<div class="container">
	<div class="screen">
		<div class="screen__content">
    <form class="login" action="updateprocess.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="iid" value="<?php echo $iid ?>">
        <div>
            <input class="login__input" type="text" id="name" name="name" placeholder="Name" value="<?php echo $name?>">
        </div>
        <br>

        <div>
            <input class="login__input" type="text" id="category" name="category" placeholder="Category" value="<?php echo $category?>" >
        </div>    
        <br>

        <div>
            <input class="login__input" type="text" id="price" name="price" placeholder="Price" value="<?php echo $price?>">
        </div>    
        <br>

        <div>
            <input class="login__input" type="text" id="description" name="description" placeholder="Description" value="<?php echo $description?>">
        </div>    
        <br>

        <div>
            <img width="50px" height="50px" src = "../images/<?php echo $image ?>">
        </div>
            <input type="hidden" name="oldimg" value="<?php echo $image ?>">
        <div style="
        align-items: center;
        justify-content:center;
        display:flex;
        ">
        <input id="selectedFile" type="file" name="img" style="display: none;">
            <input class="login__submit" type="button" name="newimg" value="Choose File" onclick="document.getElementById('selectedFile').click();" />
            <!-- <input class="login__submit" type="file" name="newimg"> -->
        </div>

        <div class="login__position">
				<input class="login__submit" type="submit" value="Update">
		</div>    
    </form>
</div> 
<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>
</html>