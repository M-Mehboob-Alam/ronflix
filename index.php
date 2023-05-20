<?php
require_once("includes/config.php");
if(!isset($_SESSION['loggedInUser'])){
    header("Location: login.php");
}else{
    echo "Welcome! ";
}
?>