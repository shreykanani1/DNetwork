<?php
session_start();
error_reporting(0);
require 'parts/db_config.php';
$user_id = $_SESSION['user_id'];

// for sign in with google
include '../vendor/config.php';
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];
$login_button = '';

if (isset($_GET["code"])) {
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
  if (!isset($token['error'])) {
    $google_client->setAccessToken($token['access_token']);
    $_SESSION['access_token'] = $token['access_token'];
    $google_service = new Google_Service_Oauth2($google_client);
    $data = $google_service->userinfo->get();

    if (!empty($data['family_name'])) {
      $_SESSION['user_last_name'] = $data['family_name'];
    }

    if (!empty($data['email'])) {
      $_SESSION['user_email_address'] = $data['email'];
      $googleemail = $data['email'];
      $sql = "SELECT * FROM user where email='$googleemail' and verification_status=1";
      $result = mysqli_query($con, $sql);
      $num = mysqli_num_rows($result);
      if ($num == 0) {
        $_SESSION['msg'] = "First signup.";
        header("Location: index.php");
      }
      $emailgoogle = $_SESSION['user_email_address'];
      $sql1 = "SELECT * FROM user where email='$emailgoogle'";
      $result1 = mysqli_query($con, $sql1);

      $row = mysqli_fetch_assoc($result1);
      $_SESSION['username'] = $row['username'];
      $_SESSION['user_id'] = $row['user_id'];
    }

    if (!empty($data['gender'])) {
      $_SESSION['user_gender'] = $data['gender'];
    }

    if (!empty($data['picture'])) {
      $_SESSION['user_image'] = $data['picture'];
    }
  }
}

if (!isset($_SESSION['access_token'])) {
  $login_button = '<a href="' . $google_client->createAuthUrl() . '">Login With Google</a>';
}

if (!empty($data['given_name'])) {
  $_SESSION['user_first_name'] = $data['given_name'];
}

if (!isset($_SESSION['email'])) {
  if (!isset($_SESSION['user_email_address'])) {
    $_SESSION['msg'] = "Something went wrong.";
    header("Location: index.php");
  }
}

// else{
//   $_SESSION['msg']="First signup.";
//   header("Location: index.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home | DNetwork</title>
  <link rel="icon" type="image/jpg" href="img/favicon-16x16.png"/>
  <?php
  require "parts/css_js.php";
  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<!-- <audio src="welcome.mp3" id="playaudio" autoplay></audio> -->
  <div class="wrapper">
    <?php
    require "parts/navbar.php";
    require "parts/sidebar.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-image: url(img/bgsocial3.jpg);background-repeat: repeat-x;
  background-attachment: fixed;
">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <center><a href="add_post.php"><button type="button" class="btn  float-sm-right" style="width:100%; background:#03599E; color:white;">Add Post</button></center>
            </div><!-- /.col -->
            <div class="col-sm-2">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="welcome.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
<?php 
$sql = "SELECT * from follow where user_id='$user_id' or u_id='$user_id' and is_accepted=1";
$result = mysqli_query($con, $sql);
$user_id_arr = array();
while ($row = mysqli_fetch_assoc($result)) 
{
  array_push($user_id_arr,$row['user_id'],$row['u_id']);
}
array_push($user_id_arr,$_SESSION['user_id']);
$user_id_arr = array_unique($user_id_arr);
// print_r($user_id_arr);
$user_all = "";
foreach ($user_id_arr as $value) {
  $user_all = $user_all . $value . ",";
}
$user_all = rtrim($user_all, ", ");
// echo $user_all;
?>

      <!-- Small boxes (Stat box) -->
      <?php
      //select friends from follow table
      $sql = "SELECT * from follow where user_id='$user_id' or u_id='$user_id' and is_accepted=1";
      // echo $sql;
      ?>
      <section class="content">
        <?php
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        // echo $num;
        $row = mysqli_fetch_assoc($result);
        
          if ($row['user_id'] != $_SESSION['user_id']) {
            $fid = $row['user_id'];
          } else {
            $fid = $row['u_id'];
          }
          // $fid2=$row['user_id'];

          //to get the post of his/her friends
          $sql1 = "SELECT * from post INNER JOIN post_file ON post.post_id=post_file.post_id  where  user_id in ($user_all) ORDER BY post.updated_on DESC";
          $result1 = mysqli_query($con, $sql1);
          // echo $sql1;
          $num1 = mysqli_num_rows($result1);

          while ($row1 = mysqli_fetch_assoc($result1)) {
            $pid = $row1['post_id'];
            $fid = $row1['user_id'];
          ?>

            <div class="container-fluid">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div class="card card-widget" style="border-radius: 15px;">
                    <div class="card-header">
                      <div class="user-block">
                        <?php
                        //to get the details of the user who posted the photo
                        $sql2 = "SELECT * from user where user_id='$fid'";
                        $result2 = mysqli_query($con, $sql2);
                        $row2 = mysqli_fetch_assoc($result2); ?>
                        <img class="img-circle" src="<?php if ($row2['profile_picture'] != null) {
                                                        echo $row2['profile_picture'];
                                                      } else {
                                                        echo "../dist/img/avatar5.png";
                                                      } ?>" alt="User Image">
                        <span class="username">
                        
                        <?php 
                          if ($user_id == $row2['user_id']) {?>
                            <a href="profile.php?uid=<?php echo $fid;?>&me=1" style="color:#03599E;">
                            <?php
                          }
                        else {
                          ?>
                            <a href="profile.php?uid=<?php echo $fid;?>" style="color:#03599E;">
                          <?php 
                        }
                        ?>
                        



                        <?php
                            echo $row2['fname'] . ' ' . $row2['lname']; ?></a></span>
                        <span class="description"><?php echo $row1['created_on']; ?></span>
                      </div>
                      <!-- /.user-block -->
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button> -->
                      </div>
                      <!-- /.card-tools -->
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                      <p><?php echo $row1['post_desc']; ?></p>
                      <center>
                        <div><img class="img-fluid pad" width="400px" src="<?php echo $row1['file_path']; ?>" alt="Photo">
                        </div>
                      </center>
                      <br>

                                                        
                      <?php
                      //to find whether user like particular post or not.
                      $sql3 = "SELECT * FROM likes where post_id='$pid' and u_id='$user_id'";
                      $result3 = mysqli_query($con, $sql3);
                      $num3 = mysqli_num_rows($result3);
                      // echo $num3;
                      // echo $sql3;
                      ?>
                        <button type="button" id="dislikebtn<?php echo($pid); ?>" class="btn btn-default btn-sm <?php  if ($num3 == 0) {echo('d-none');} ?>" onclick="setDislike(<?php echo $pid; ?>)"><i class="fas fa-thumbs-up"></i> Like</button>
                      
                        <button type="button" id="likebtn<?php echo($pid); ?>" class="btn btn-default btn-sm <?php  if ($num3 >= 1) {echo('d-none');} ?>" onclick="setlike(<?php echo $pid; ?>)"><i class="far fa-thumbs-up"></i> Like</button>
                     

                      <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button> -->
                      <span class="float-right text-muted" id="postLikes<?php echo($pid); ?>"><?php
                      // to get the number of like and comment
                              $sql4 = "SELECT * FROM likes where post_id='$pid'";
                              $result4 = mysqli_query($con, $sql4);
                              $num4 = mysqli_num_rows($result4);
                              //  echo $sql4;
                              echo $num4; ?> Likes<?php

                              $sql6 = "SELECT * from comments where post_id='$pid'";
                              $result6 = mysqli_query($con, $sql6);
                              $row6 = mysqli_fetch_assoc($result6);
                              $num6 = mysqli_num_rows($result6);
                              // echo $num6;

                              ?> </span>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer card-comments"><?php
                                                            $sql5 = "SELECT * from comments INNER JOIN user ON comments.u_id=user.user_id where post_id='$pid' order by comment_id desc";
                                                            // echo $sql5;
                                                            $result5 = mysqli_query($con, $sql5);
                                                            while ($row5 = mysqli_fetch_assoc($result5)) { ?>
                        <div class="card-comment">
                          <!-- User image -->
                          <img class="img-circle img-sm" src="<?php if ($row5['profile_picture'] != null) {
                                                                echo $row5['profile_picture'];
                                                              } else {
                                                                echo "../dist/img/avatar5.png";
                                                              } ?>" alt="User Image">
                          <?php
                          ?>
                          <div class="comment-text">
                            <span class="username" style="color:#03599E;">
                              <?php
                                                              if($row5['fname'] != '' && $row5['lname']!='') {
                                                                echo $row5['fname']." ".$row5['lname'];
                                                              }
                                                              else {
                                                                echo $row5['username'];
                                                              }
                              ?>
                              <span class="text-muted float-right"><?php echo $row6['created_on']; ?></span>
                            </span><!-- /.username -->
                            <?php

                                                              // echo $sql5;
                                                              echo $row5['description'];
                            ?>
                            
                          </div>
                          <!-- /.comment-text -->
                        </div>
                      <?php
                                                            }
                      ?>

                      <!-- /.card-comment -->
                    </div>
                    <span class="text-muted float-right" id="postComment<?php echo($pid); ?>"></span>
                    <!-- /.card-footer -->
                    <div class="card-footer">
                      
                        <?php
                        $sql7 = "SELECT * from user where user_id='$user_id'";
                        $result7 = mysqli_query($con, $sql7);
                        $row7 = mysqli_fetch_assoc($result7); ?>
                        <img class="img-fluid img-circle img-sm" src="<?php if ($row7['profile_picture'] != null) {
                                                                        echo $row7['profile_picture'];
                                                                      } else {
                                                                        echo "../dist/img/avatar5.png";
                                                                      } ?>" alt="Alt Text">
                        <!-- .img-push is used to add margin to elements next to floating images -->
                        <div class="img-push">
                          
                            <div class="row ">
                              
                                <input type="text" id="commentContent<?php echo($pid); ?>" class="form-control form-control-sm mr-2 ml-2 md-form" style="width:78%" placeholder="Press enter to post comment" name="comment">
                                <div class="pull-right">
                                <button type="button" id="likebtn<?php echo($pid); ?>" class="btn btn-sm responsive-width" style="background:#E64B3B;color:white;" onclick="setComment(<?php echo $pid; ?>)"> Enter</button>
                                </div>
                              
                              
                            </div>
                          


                        </div>
                      
                    </div>
                    <!-- /.card-footer -->
                  </div>

                </div>
                <div class="col-md-2"></div>
              <?php
            } ?>

            <?php
          
            ?>
              </div>
      </section>

      <!-- /.row -->
      <!-- /.container-fluid -->

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->
  <?php
  require "parts/footer.php";
  ?>
  <div class="loader"></div>
  
  <script>
    $(window).on("load", function() {
      
      $(".loader").fadeOut("slow");
    });
    
  </script>

  <script>
  function setDislike(pid) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById("postLikes"+pid).innerHTML = this.responseText.concat(' Likes');
      $('#likebtn'+pid).removeClass("d-none");
      $('#dislikebtn'+pid).addClass("d-none");
      }
    };
    xhttp.open("GET", "con_dislike.php?pid="+pid, true);
    xhttp.send();
  }
  function setlike(pid) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById("postLikes"+pid).innerHTML = this.responseText.concat(' Likes');
      $('#likebtn'+pid).addClass("d-none");
      $('#dislikebtn'+pid).removeClass("d-none");
      }
    };
    xhttp.open("GET", "con_like.php?pid="+pid, true);
    xhttp.send();
  }

  function setComment(pid) {
    var xhttp = new XMLHttpRequest();
    var commentContent = document.getElementById('commentContent'+pid).value;
    // console.log(commentContent);
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById("postComment"+pid).innerHTML = this.responseText;
      console.log(document.getElementById("postComment"+pid).innerHTML);
      }
    };
    xhttp.open("GET", "con_comment.php?pid="+pid+"&commentContent="+commentContent, true);
    xhttp.send();
  }

  function playSound(url) {
  const audio = new Audio(url);
  audio.play();
}
  </script>
</body>

</html>