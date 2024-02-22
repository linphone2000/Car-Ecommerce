<?php
include 'connection.php';
$deleteid = $_GET['did'];
// echo $deleteid;
$sql2 = $db->prepare("DELETE FROM myorder WHERE oid=$deleteid");
$sql2->execute();
header('Location: ../admin/vieworder.php');
?>