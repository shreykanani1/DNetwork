<?php
include('parts/db_config.php');
$id=mysqli_real_escape_string($con,$_GET['id']);
mysqli_query($con,"update user set verification_status='1' where verification_id='$id'");
echo "Your account verified";
?>
<br>

<a href="index.php"> Click here for Login</a>