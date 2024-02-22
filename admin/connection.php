<?php
try{
    $db = new PDO("mysql:hostname=localhost;dbname=rev_up_auto","root","");
    $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "Connection Successful!<br>";
}catch(PDOException $e){
    echo $e->getMessage();
}
