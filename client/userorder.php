<?php
    session_start();
    $nametouse =  $_SESSION['username'];
    include '../admin/connection.php';
    if(isset($_SESSION['cart'])){
        try{
            $sql1 = "SELECT * FROM customer WHERE cemail='$nametouse'";
            $sq1 = $db->prepare($sql1);
            $sq1 ->execute();
            while($row=$sq1->fetch(PDO::FETCH_ASSOC)){
                extract($row);
            }
            foreach($_SESSION['cart'] as $key => $product){
            echo "Order data inserted";
            $oname = $product['name'];
            $oprice = $product['price'];
            $oquantity = $product['quantity'];
            date_default_timezone_set("Asia/Yangon");
            $date = date('d/m/Y h:i:s A');
            try{
                $sql = "INSERT INTO myorder(cid, oname, quantity, price, date)
                               VALUE($cid,'$oname','$oquantity','$oprice','$date')";
                $db->exec($sql);
                unset($_SESSION['cart']);
                echo"<script>alert('Order successfully created!');window.location.href = '../client/clientpage.php';</script>";
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }//end foreach
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    //<--Insert into Customer table

    }//end if
?>