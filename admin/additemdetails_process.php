<?php
    include '../admin/connection.php';
    $itemid = $_POST['itemid'];
    $detail1 = $_POST['detail1'];
    $detail2 = $_POST['detail2'];
    $detail3 = $_POST['detail3'];
    $detail4 = $_POST['detail4'];
    $detail5 = $_POST['detail5'];
    $detail6 = $_POST['detail6'];
    echo $itemid;
    // Photos 1
    if(isset($_FILES['mphoto1'])){
        $error = array();
        $filaname = $_FILES['mphoto1']['name'];//logo.jpg
        $filesize = $_FILES['mphoto1']['size'];//Bytes
        $filetype = $_FILES['mphoto1']['type'];//logo/jpg
        $filetmp = $_FILES['mphoto1']['tmp_name'];//temp name
        $mphoto1 = $filaname;
    
        $file_ex = explode("/",$filetype); //[logo][jpg]
        $filex = strtolower(end($file_ex));
    
        $extension = array("jpg","jpeg","png","gif","jif","webp");
        if(in_array($filex,$extension)==FALSE){//finding an item in an array
            echo "Wrong file type!<br>";
            $error[] = "Wrong file type!";
        }
        elseif($filesize>2097152){
            echo "Large file!<br>";
            $error[] = "File larger than 2 Megabyte!";
        }
        elseif(empty($error)==TRUE){
            echo "Image 1 Uploaded!<br>";
            move_uploaded_file($filetmp,"../images/".$filaname); //temp_name,destination with file name
        }
    }
    // Photo 2
    if(isset($_FILES['mphoto2'])){
        $error = array();
        $filaname = $_FILES['mphoto2']['name'];//logo.jpg
        $filesize = $_FILES['mphoto2']['size'];//Bytes
        $filetype = $_FILES['mphoto2']['type'];//logo/jpg
        $filetmp = $_FILES['mphoto2']['tmp_name'];//temp name
        $mphoto2 = $filaname;
    
        $file_ex = explode("/",$filetype); //[logo][jpg]
        $filex = strtolower(end($file_ex));
    
        $extension = array("jpg","jpeg","png","gif","jif","webp");
        if(in_array($filex,$extension)==FALSE){//finding an item in an array
            echo "Wrong file type!<br>";
            $error[] = "Wrong file type!";
        }
        elseif($filesize>2097152){
            echo "Large file!<br>";
            $error[] = "File larger than 2 Megabyte!";
        }
        elseif(empty($error)==TRUE){
            echo "Image 2 Uploaded!<br>";
            move_uploaded_file($filetmp,"../images/".$filaname); //temp_name,destination with file name
        }
    }
    // Photo 3
    if(isset($_FILES['mphoto3'])){
        $error = array();
        $filaname = $_FILES['mphoto3']['name'];//logo.jpg
        $filesize = $_FILES['mphoto3']['size'];//Bytes
        $filetype = $_FILES['mphoto3']['type'];//logo/jpg
        $filetmp = $_FILES['mphoto3']['tmp_name'];//temp name
        $mphoto3 = $filaname;
    
        $file_ex = explode("/",$filetype); //[logo][jpg]
        $filex = strtolower(end($file_ex));
    
        $extension = array("jpg","jpeg","png","gif","jif","webp");
        if(in_array($filex,$extension)==FALSE){//finding an item in an array
            echo "Wrong file type!<br>";
            $error[] = "Wrong file type!";
        }
        elseif($filesize>2097152){
            echo "Large file!<br>";
            $error[] = "File larger than 2 Megabyte!";
        }
        elseif(empty($error)==TRUE){
            echo "Image 3 Uploaded!<br>";
            move_uploaded_file($filetmp,"../images/".$filaname); //temp_name,destination with file name
        }
    }
    // Photos
    try{
        $sql = "INSERT INTO moredata(iid, detail1, detail2, detail3, detail4, detail5, detail6, mphoto1, mphoto2, mphoto3)
                       VALUE('$itemid','$detail1','$detail2','$detail3','$detail4','$detail5','$detail6','$mphoto1','$mphoto2','$mphoto3')";
        $db->exec($sql);
        echo"<script>alert('Details Added!');window.location.href = '../admin/viewitem.php';</script>";
        // header('Location: ../admin/viewitem.php');
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>