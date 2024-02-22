<?php
    session_start();
    $adminemail = $_POST['username'];
    $password = $_POST['password'];
    $username_array = array();
    $password_array = array();
    include '../admin/connection.php';
    $sql1 = "SELECT * FROM admin";
    $sq1 = $db->prepare($sql1);
    $sq1 ->execute();
    while($row=$sq1->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($username_array,$email);
        array_push($password_array,$password);
    }
    echo $adminemail;
    echo $password;
    print_r($username_array);
    print_r($password_array);
    if(in_array($adminemail,$username_array) && in_array($password,$password_array)){
        $sql2 = "SELECT username FROM admin WHERE email='$adminemail'";
        $sq2 = $db->prepare($sql2);
        $sq2->execute();
        $row2 = $sq2->fetch(PDO::FETCH_ASSOC);
        extract($row2);
        $_SESSION['adminname'] = $username;
        echo "Logged in! Username = ".$_SESSION['adminname'];
        echo"<script>alert('Logged In!');window.location.href = '../admin/dashboard.php';</script>";
    }
    else{
        echo "User does not exist or wrong credentials";
        echo"<script>alert('User does not exist or wrong credentials!');window.location.href = '../admin/adminlogin.php';</script>";
    }
?>