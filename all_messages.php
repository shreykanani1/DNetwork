<?php 
require 'parts/db_config.php';
session_start();

$text = $_POST['text'];
$u_id = $_POST['userid'];
$user_id = $_SESSION['user_id'];

$sql2 = "SELECT * FROM messages where (user_id='$user_id' and u_id='$u_id') or (user_id='$u_id' and u_id='$user_id') order by message_id desc";
// echo $sql2;
$result2=mysqli_query($con,$sql2);
// header("Location: message.php");
$res="";
if (mysqli_num_rows($result2)>0) {
    while ($row2=mysqli_fetch_assoc($result2)) {
        $msgid= $row2['message_id'];
        if ($row2['user_id']!=$user_id) {
            $sql3 = "UPDATE messages SET is_seen = '1' WHERE message_id = $msgid ;";
            $result3 = mysqli_query($con, $sql3);
        }
        
        



        $msguid = $row2['user_id'];
        $sql1 = "SELECT * FROM USER WHERE user_id = '$msguid'";
        $result1 = mysqli_query($con, $sql1);
       
        $row1 = mysqli_fetch_assoc($result1);
        ?>
        <div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left"><?php if($row1['fname'] != '' && $row1['lname']!='') {
                                                                echo $row1['fname']." ".$row1['lname'];
                                                            }
                                                            else {
                                                                echo $row1['username'];
                                                            }  ?></span>
                <span class="direct-chat-timestamp float-right"><?php echo $row2['created_on'] ?></span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="<?php if ($row1['profile_picture'] != null) {
                                                echo $row1['profile_picture'];
                                            } else {
                                                echo "../dist/img/avatar5.png";
                                            } ?>" alt="Message User Image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                <?php echo $row2['description']; ?>
            </div>
            <!-- /.direct-chat-text -->
        </div><?php 
    }
}
// echo $res;
?>
<!-- // echo $sql1;
        $res = $res . '<div class="direct-chat-msg">' . '<div class="direct-chat-infos clearfix">' . '<span class="direct-chat-name float-left">';
        $res = $res .$row1['fname'] . ' ' . $row1['lname'] . '</span>' . '<span class="direct-chat-timestamp float-right">';
        $res = $res . $row2['created_on'].'</span></div>' . '<img class="direct-chat-img" src="" alt="Message User Image">' . '<div class="direct-chat-text">' . $row2['description'] . '</div>' . '</div>' . '</div>';
        // echo 'shrey'; -->
