<?php
include 'connection.php';
$did = $_GET['did'];
$sql = $db->prepare("DELETE FROM item WHERE iid=$did");
$sql->execute();

$sql2 = $db->prepare("DELETE FROM moredata WHERE iid=$did");
$sql2->execute();
header('Location: ../admin/viewitem.php');
?>