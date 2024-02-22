<?php
    include '../admin/connection.php';
    $error = '';
    $result = '';
    if(isset($_POST['searchbutton'])){
        if(isset($_POST['search'])){
            $name = $_POST['search'];
            $sql = $db->prepare("SELECT * FROM item WHERE name LIKE '%$name' or description like '%$name'");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            print_r($result);
        }
        else{
            $error = "Please enter the information!";
        }
    }
?>