<?php 
require 'parts/db_config.php';
session_start();
$comment = $_GET['commentContent'];
$pid=$_GET['pid'];
$user_id = $_SESSION['user_id'];

$sql2 = "INSERT INTO comments (comment_id, post_id, u_id, description, created_on) VALUES (NULL, '$pid', '$user_id', '$comment', current_timestamp());";
// echo $sql2;
$result2=mysqli_query($con,$sql2);

    $sql = "select description as descp from comments where post_id='$pid' order by comment_id desc";
    $resultComment = mysqli_query($con,$sql);
    // echo $sql;
    if($row = mysqli_fetch_assoc($resultComment)){
        echo('Your comment '.$row['descp']. ' inserted successfully');
    }
    else{
        echo("0");
    }
// echo $sql2;

    // header("Location: profile.php?uid=$user_id&me=1");

    // header("Location: welcome.php");

?>