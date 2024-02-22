<?php
    include '../admin/connection.php';
    $mid = $_POST['mid'];
    $itemid = $_POST['itemid'];
    $detail1 = $_POST['detail1'];
    $detail2 = $_POST['detail2'];
    $detail3 = $_POST['detail3'];
    $detail4 = $_POST['detail4'];
    $detail5 = $_POST['detail5'];
    $detail6 = $_POST['detail6'];
    $mphoto1 = $_POST['mphoto1'];
    $mphoto2 = $_POST['mphoto2'];
    $mphoto3 = $_POST['mphoto3'];
    echo $itemid;
    echo $mid;
    try{
    $sql = $db->prepare("UPDATE moredata SET mid='$mid',iid='$itemid', detail1='$detail1', detail2='$detail2',
    detail3='$detail3', detail4='$detail4', detail5='$detail5', detail6='$detail6',
    mphoto1='$mphoto1',mphoto2='$mphoto2',mphoto3='$mphoto3' WHERE iid='$itemid'");
    $sql->execute();
    header('Location: ../admin/viewitemdetails.php');
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>