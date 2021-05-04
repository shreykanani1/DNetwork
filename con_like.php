<?php 
require 'parts/db_config.php';
session_start();
$fid = $_GET['uid'];
$user_id=$_SESSION['user_id'];
$pid=$_GET['pid'];

//for welcome page


    $sql2 = "INSERT INTO likes (like_id, post_id, u_id, created_on) VALUES (NULL, '$pid', '$user_id', current_timestamp())";
    $resultLikes2=mysqli_query($con,$sql2);
    // echo $sql2;
    // header("Location: welcome.php");
    $sql = "select count(1) as totalLikes from likes where post_id='$pid'";
    $resultLikes = mysqli_query($con,$sql);
    if($row2 = mysqli_fetch_assoc($resultLikes)){
        echo($row2['totalLikes']);
    }
    else{
        echo("0");
    }


// echo $sql2;

?>