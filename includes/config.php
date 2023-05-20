<?php
ob_start();
session_start();

date_default_timezone_set("Asia/Karachi");

try {
    $con = new PDO("mysql:dbname=ronflix;host=localhost","root","");
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    echo("Connection Failed due to ".$e->getMessage());
}
?>