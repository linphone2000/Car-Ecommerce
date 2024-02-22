<?php
include 'connection.php';
try{
    $sql = "CREATE TABLE item(
        iid INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(iid),
        name VARCHAR(225),
        category VARCHAR(225),
        price INT,
        description VARCHAR(225),
        image VARCHAR(225)
    )";
    $db->exec($sql);
    echo "Table Created!";
}catch(PDOException $e){
    echo $e->getMessage();
}
