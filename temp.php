<?php
    $username = "root";
    $password = "";
    $connection = new PDO("mysql:database;host=localhost",$username,$password);
    if($connection)
    {
     echo 'connecition ok';   
    }
?>
