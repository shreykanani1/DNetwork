<?php 
session_start();
error_reporting(0);
require 'parts/db_config.php';
include 'parts/css_js.php';
include 'parts/CommonFunctions.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql1 = "DELETE FROM user WHERE user_id=$user_id;";
    $result1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_assoc($result1);
    // echo $sql1;


    $sql3 = "DELETE FROM post WHERE user_id=$user_id;";
    $result3 = mysqli_query($con,$sql3);
    $row3 = mysqli_fetch_assoc($result3);



    $sql4 = "DELETE FROM likes WHERE u_id=$user_id;";
    $result4 = mysqli_query($con,$sql4);
    $row4 = mysqli_fetch_assoc($result4);



    $sql5 = "DELETE FROM comments WHERE u_id=$user_id;";
    $result5 = mysqli_query($con,$sql5);
    $row5 = mysqli_fetch_assoc($result5);



    $sql6 = "DELETE FROM messages WHERE user_id=$user_id or u_id=$user_id;";
    $result6 = mysqli_query($con,$sql6);
    $row6 = mysqli_fetch_assoc($result6);


    $sql7 = "DELETE FROM follow WHERE user_id=$user_id or u_id=$user_id;";
    $result7 = mysqli_query($con,$sql7);
    $row7 = mysqli_fetch_assoc($result7);
    // echo $sql1;
    session_start();
    session_unset();
    session_destroy();
    header("Location: signup.php");
}

else {
    header("Location: index.php");
}


?>
