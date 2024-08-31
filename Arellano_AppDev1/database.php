<?php
$Host = "localhost";
$Databasename = "arellanodb";
$UserName = "CRUD";
$Password = "crud";

try {
    $con = new PDO("mysql:host={$Host};dbname={$Databasename}", $UserName, $Password);  
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection Failed: " . $exception->getMessage();
}
?>
