<?php 
require 'parts/db_config.php';
session_start();
$user_id=$_SESSION['user_id'];
$pid=$_GET['pid'];

//for welcome page

    $sql = "DELETE FROM likes where post_id='$pid' and u_id='$user_id'";
    $result=mysqli_query($con,$sql);
    // echo $sql;

    $sql = "select count(1) as totalLikes from likes where post_id='$pid'";
    $resultLikes = mysqli_query($con,$sql);
    if($row = mysqli_fetch_assoc($resultLikes)){
        echo($row['totalLikes']);
    }
    else{
        echo("0");
    }
    



// echo $sql2;

?>