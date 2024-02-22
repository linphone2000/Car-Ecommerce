<?php
    include '../admin/connection.php';
    $sql1 = "SELECT * FROM customer";
    $sq1 = $db->prepare($sql1);
    $sq1 ->execute();
    $username_array = array();
    $password_array = array();
    while($row=$sq1->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($username_array,$cemail);
        array_push($password_array,$cpassword);
    }
    //Insert into Customer table-->
        $cname = $_POST['cname'];
        $cemail = $_POST['cemail'];
        $cpassword = $_POST['cpassword'];
        $cpayment = $_POST['cpayment'];
        $caddress1 = $_POST['caddress1'];
        $caddress2 = $_POST['caddress2'];
        $ccity = $_POST['ccity'];
        $cstate = $_POST['cstate'];
        $czip = $_POST['czip'];
        $ccardnumber = $_POST['ccardnumber'];
        if(in_array($cemail,$username_array)){
            echo"<script>alert('User already existed!');window.location.href = '../client/login.php';</script>";
        }else{
        try{
            $sql = "INSERT INTO customer(cname, cemail, cpassword, cpayment, caddress1, caddress2, ccity, cstate, czip, ccardnumber)
                           VALUE('$cname','$cemail','$cpassword','$cpayment','$caddress1','$caddress2','$ccity','$cstate','$czip','$ccardnumber')";
            $db->exec($sql);
            echo"<script>alert('Registered!');window.location.href = '../client/login.php';</script>";
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    //<--Insert into Customer table

?>