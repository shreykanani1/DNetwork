<?php 
session_start();
error_reporting(0);
require 'parts/db_config.php';
include 'parts/css_js.php';
include 'parts/CommonFunctions.php';

$pid = $_GET['pid'];
$user_id = $_SESSION['user_id'];



    $postdesc = $_POST['postdesc'];
    $sql1 = "DELETE FROM post WHERE post_id=$pid;";
    $result1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $sql = "DELETE FROM post_file WHERE post_id=$pid;";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    // echo $sql1;
    header("Location: welcome.php");

?>
