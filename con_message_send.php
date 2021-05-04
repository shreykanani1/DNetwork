<?php
require 'parts/db_config.php';
session_start();

$text = $_POST['text'];
$u_id = $_POST['userid'];
$user_id = $_SESSION['user_id'];

$sql2 = "INSERT INTO messages (message_id, user_id, u_id, description, created_on) VALUES (NULL, '$user_id', '$u_id', '$text', current_timestamp());";
// echo $sql2;
$result2=mysqli_query($con,$sql2);
// header("Location: message.php");
?>