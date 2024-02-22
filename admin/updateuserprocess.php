<?php
    include '../admin/connection.php';
    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
    $cemail = $_POST['cemail'];
    $cpayment = $_POST['cpayment'];
    $caddress1 = $_POST['caddress1'];
    $caddress2 = $_POST['caddress2'];
    $ccity = $_POST['ccity'];
    $cstate = $_POST['cstate'];
    $czip = $_POST['czip'];
    $ccardnumber = $_POST['ccardnumber'];

    $sql = $db->prepare("UPDATE customer SET cid='$cid', cname='$cname', cemail='$cemail',
    cpayment='$cpayment', caddress1='$caddress1', caddress2='$caddress2', ccity='$ccity', cstate='$cstate',czip='$czip',
    ccardnumber='$ccardnumber' WHERE ciD='$cid'");
    $sql->execute();
    echo"<script>alert('User Information Updated!');window.location.href = '../admin/viewuser.php';</script>";
?>