<?php 
echo "<script> window.confirm('Are you sure to logout?');</script>";
    session_start();
    session_unset();
    session_destroy();
    
    header("Location: index.php");
    exit();
?>