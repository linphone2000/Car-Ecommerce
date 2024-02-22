<?php
    include '../admin/connection.php';
    $sql1 = "SELECT * FROM admin";
    $sq1 = $db->prepare($sql1);
    $sq1 ->execute();
    $username_array = array();
    $password_array = array();
    while($row=$sq1->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($username_array,$cemail);
        array_push($password_array,$cpassword);
    }
        $cname = $_POST['cname'];
        $cemail = $_POST['cemail'];
        $cpassword = $_POST['cpassword'];
        if(in_array($cemail,$username_array)){
            echo"<script>alert('User already existed!');window.location.href = '../client/login.php';</script>";
        }else{
        try{
            $sql = "INSERT INTO admin(username, email, password)
                           VALUE('$cname','$cemail','$cpassword')";
            $db->exec($sql);
            echo"<script>alert('Registered!');window.location.href = '../client/login.php';</script>";
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    //<--Insert into Customer table

?>