<?php
session_start();
error_reporting(0);
$uid = $_GET['uid'];
$user_id = $_SESSION['user_id'];

include 'parts/db_config.php';
$username = $_SESSION['username'];


$sql3 = "SELECT * FROM USER WHERE user_id = '$uid'";
$result3 = mysqli_query($con, $sql3);

//  echo $sql3;
$row3 = mysqli_fetch_assoc($result3);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if ($row3['fname'] != '' && $row3['lname'] != '') {
                echo $row3['fname'] . " " . $row3['lname'];
            } else {
                echo $row3['username'];
            } ?> | DNetwork</title>
    <link rel="icon" type="image/jpg" href="img/favicon-16x16.png" />
    <?php
    require("parts/css_js.php");
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="container-fluid">
            <?php
            require("parts/navbar.php");
            require("parts/sidebar.php");
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">

                                <h3 class="m-0 text-dark"><?php if ($row3['fname'] != '' && $row3['lname'] != '') {
                                                                echo $row3['fname'] . " " . $row3['lname'];
                                                            } else {
                                                                echo $row3['username'];
                                                            } ?> </h3>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active">Messages</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <div class="container bg-white rounded-lg shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="direct-chat-messages anyclass" style="height:350px;overflow-y:scroll;">
                        <?php
                        $sql = "SELECT * FROM messages where (user_id='$user_id' and u_id='$uid') or (user_id='$uid' and u_id='$user_id') order by message_id desc";

                        $result = mysqli_query($con, $sql);

                        // echo $sql;
                        while ($row = mysqli_fetch_assoc($result)) {

                            $user_id = $row['user_id'];
                            $u_id = $row['u_id'];

                            $sql1 = "SELECT * FROM USER WHERE user_id = '$user_id'";
                            $result1 = mysqli_query($con, $sql1);
                            // echo $sql;
                            $row1 = mysqli_fetch_assoc($result1);
                        ?>
                            <!-- Main content -->


                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left"><?php if ($row1['fname'] != '' && $row1['lname'] != '') {
                                                                                    echo $row1['fname'] . " " . $row1['lname'];
                                                                                } else {
                                                                                    echo $row1['username'];
                                                                                }  ?></span>
                                    <span class="direct-chat-timestamp float-right"><?php echo $row['created_on'] ?></span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="<?php if ($row1['profile_picture'] != null) {
                                                                        echo $row1['profile_picture'];
                                                                    } else {
                                                                        echo "../dist/img/avatar5.png";
                                                                    } ?>" alt="Message User Image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    <?php echo $row['description']; ?>
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>


                        <?php }
                        ?>

                    </div>

                </div>
                <!-- /.content -->
                <br>
                <div class="container">
                    <div class="row">

                        <input type="text" id="usermsg" class="form-control form-control-sm md-form ml-3" style="width:78%" placeholder="Enter your message">

                        <button type="button" id="sendBtn" class="btn btn-sm ml-3" style="background:#E64B3B;color:white;">Send</button>
                    </div>
                </div>


            </div>
        </div>
        <!-- /.content-wrapper -->

    </div>


    <!-- ./wrapper -->
    <?php
    require("parts/footer.php");
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        // Get the input field
        var input = document.getElementById("usermsg");

        // Execute a function when the user releases a key on the keyboard
        input.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                // Cancel the default action, if needed
                event.preventDefault();
                // Trigger the button element with a click
                document.getElementById("sendBtn").click();
            }
        });
        setInterval(runFunction, 1000);

        function runFunction() {
            $.post("all_messages.php", {
                    userid: '<?php echo $uid; ?>'
                },
                function(data, status) {
                    document.getElementsByClassName('anyclass')[0].innerHTML = data;
                    console.log(document.getElementsByClassName('anyclass')[0]);
                    // alert(status);
                }
            )
        }

        $("#sendBtn").click(function() {
            var clientmsg = $("#usermsg").val();
            $.post("con_message_send.php", {
                    text: clientmsg,
                    userid: '<?php echo $uid; ?>'
                },
                function(data, status) {

                    document.getElementsByClassName('anyclass')[0].innerHTML = data;
                    // alert('data : '+data +'\nsuccess : '+status);

                });
            $("#usermsg").val('');
            return false;
        });
    </script>
</body>

</html>