<?php 
require 'parts/db_config.php';
session_start();


$pid = $_POST['pid'];
$user_id = $_SESSION['user_id'];

$sql2 = "SELECT * FROM comments where (post_id='$pid') order by comment_id desc";
echo $sql2;
$result2=mysqli_query($con,$sql2);
// header("Location: message.php");
$res="";
if (mysqli_num_rows($result2)>0) {
    while ($row2=mysqli_fetch_assoc($result2)) {
        $msguid = $row2['u_id'];
        $sql1 = "SELECT * FROM USER WHERE user_id = '$msguid'";
        $result1 = mysqli_query($con, $sql1);
       
        $row1 = mysqli_fetch_assoc($result1);
        ?>


<div class="card-comment">
                        <!-- User image -->
    <img class="img-circle img-sm" src="<?php if ($row1['profile_picture'] != null) {
                                            echo $row1['profile_picture'];
                                        } else {
                                            echo "../dist/img/avatar5.png";
                                        } ?>" alt="User Image">
    <?php
    ?>                 
        <div class="comment-text">
            <span class="username">
            <?php
            echo $row1['fname'] . ' ' . $row1['lname'];
            ?>
            <span class="text-muted float-right"><?php echo $row2['created_on']; ?></span>
            </span><!-- /.username -->
            <span id="postComment<?php echo ($pid); ?>"><?php echo $row2['description']; ?></span>

        </div>
                <!-- /.comment-text -->
        </div> 
        <?php 
    }
}
// echo $res;
?>
<!-- // echo $sql1;
        $res = $res . '<div class="direct-chat-msg">' . '<div class="direct-chat-infos clearfix">' . '<span class="direct-chat-name float-left">';
        $res = $res .$row1['fname'] . ' ' . $row1['lname'] . '</span>' . '<span class="direct-chat-timestamp float-right">';
        $res = $res . $row2['created_on'].'</span></div>' . '<img class="direct-chat-img" src="" alt="Message User Image">' . '<div class="direct-chat-text">' . $row2['description'] . '</div>' . '</div>' . '</div>';
        // echo 'shrey'; -->
