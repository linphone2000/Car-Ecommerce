<?php
include 'connection.php';
$deleteid = $_GET['deleteid'];
// echo $deleteid;
$sql2 = $db->prepare("DELETE FROM myorder WHERE cid=$deleteid");
$sql2->execute();
$sql = $db->prepare("DELETE FROM customer WHERE cid=$deleteid");
$sql->execute();
header('Location: ../admin/viewuser.php');
?>