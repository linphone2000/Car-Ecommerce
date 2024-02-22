<?php
include 'connection.php';
try{
$sql = "CREATE DATABASE rev_up_auto";
$db->exec($sql);
echo "Data base created";
}catch(PDOException $e){
    echo $e->getMessage();
}