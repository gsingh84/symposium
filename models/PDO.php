<?php

require "../../../symposiumConfig.php";


try{
    //Instantiate a database object
    $_models_dbh = new PDO(DB_DSN,
        DB_USERNAME, DB_PASSWORD);

//    echo "connected to database!";
}
catch(PDOException $e){
    echo "fail: " . $e->getMessage();
    echo $e->getMessage();
}