<?php
include 'connection.php';
$did = $_GET['did'];
$sql = $db->prepare("DELETE FROM moredata WHERE iid=$did");
$sql->execute();

header('Location: ../admin/viewitemdetails.php');
?>