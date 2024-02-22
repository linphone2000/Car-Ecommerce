<?php
    session_start();
    // var_dump($_POST);
    // var_dump($_REQUEST);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username_array = array();
    $password_array = array();
    // echo "<br>"."Username: ".$username;
    // echo "<br>"."Username: ".$password;
    include '../admin/connection.php';
    $sql1 = "SELECT * FROM customer";
    $sq1 = $db->prepare($sql1);
    $sq1 ->execute();
    while($row=$sq1->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($username_array,$cemail);
        array_push($password_array,$cpassword);
    }
    if(in_array($username,$username_array) && in_array($password,$password_array)){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $sql2 = "SELECT cname FROM customer WHERE cemail='$username'";
        $sq2 = $db->prepare($sql2);
        $sq2->execute();
        $row2 = $sq2->fetch(PDO::FETCH_ASSOC);
        extract($row2);
        $_SESSION['name'] = $cname;
        echo "Logged in!";
        echo"<script>alert('Logged In!');window.location.href = '../client/clientpage.php';</script>";
    }
    else{
        echo "User does not exist or wrong credentials";
        echo"<script>alert('User does not exist or wrong credentials!');window.location.href = '../client/login.php';</script>";
    }
?>