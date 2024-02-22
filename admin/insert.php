<?php
if(isset($_FILES['img'])){
    echo "<br>Checking file!<br>";
    $error = array();
    $filaname = $_FILES['img']['name'];//logo.jpg
    $filesize = $_FILES['img']['size'];//Bytes
    $filetype = $_FILES['img']['type'];//logo/jpg
    $filetmp = $_FILES['img']['tmp_name'];//temp name

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
        echo "Image Uploaded!<br>";
        move_uploaded_file($filetmp,"../images/".$filaname); //temp_name,destination with file name
    }
}
$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$description = $_POST['description'];
$image = $filaname;
include 'connection.php';
try{
    $sql = "INSERT INTO item(name, category, price, description, image)
                   VALUE('$name','$category','$price','$description','$image')";
    $db->exec($sql);
    echo "Data Inserted";
    header('Location: ../admin/viewitem.php');
}catch(PDOException $e){
    echo $e->getMessage();
}

// $sql = "INSERT INTO item(name, category, price, description, image)
//                 VALUE(?,?,?,?,?)";
// $sq = $db->prepare($sql);
// if($sq->execute(array($name,$category,$price,$description,$image))){
//     echo "Data Inserted";
// }
?>