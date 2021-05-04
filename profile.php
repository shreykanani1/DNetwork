<?php 
  session_start();
  error_reporting(0);
  $uid = $_GET['uid'];
  $user_id=$_SESSION['user_id'];
  
  include 'parts/db_config.php';
  $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile | DNetwork</title>
  <link rel="icon" type="image/jpg" href="img/favicon-16x16.png"/>
  <?php
    require("parts/css_js.php");
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
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
            <h1 class="m-0 text-dark">Profile </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php 
  $sql = "SELECT * FROM user where user_id='$uid' and verification_status=1";
   $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
    // echo $sql;
    ?>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center"><?php
                $sql111 = "SELECT * from user where user_id='$user_id'";
                $result111=mysqli_query($con,$sql111);
                $row111 = mysqli_fetch_assoc($result111);
                //to check whether user search for its own account or anyone else account
                if(isset($_GET['me'])){
                  $sql10 = "SELECT * from user where user_id='$user_id'";
                }
                else{
                  $sql10 = "SELECT * from user where user_id='$uid'";
                }
                $result10=mysqli_query($con,$sql10);
                $row10 = mysqli_fetch_assoc($result10);?>
                  <img class="profile-user-img img-fluid img-circle" src="<?php if($row10['profile_picture']!=NULL){echo $row10['profile_picture'];}else{ echo "../dist/img/avatar5.png";}?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><b><?php echo $row10['fname'].' '.$row10['lname']?></b> </h3>

                <p class="text-muted text-center"><?php echo $row10['branch']?></p>

                <ul class="list-group list-group-unbordered mb-3">
                <?php 
                
                $sql9 = "SELECT * from follow where (user_id='$uid' or u_id='$uid') and is_accepted=1";
                // echo $sql9;
                  $result9=mysqli_query($con,$sql9);
                  $num9 = mysqli_num_rows($result9);
                ?>


                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Connections</b> <a class="float-right"><?php echo $num9;?></a>
                  </li>
                </ul><?php
                //if(!isset($_GET['me'])){

                
                  $sql1 = "SELECT * FROM FOLLOW WHERE user_id='$user_id' and u_id='$uid'";
                  $result1=mysqli_query($con,$sql1);
                  $row1=mysqli_fetch_assoc($result1);
                  $num1 = mysqli_num_rows($result1);


                  $sql2 = "SELECT * FROM FOLLOW WHERE user_id='$user_id' and u_id='$uid' and is_accepted='0'";
                  $result2=mysqli_query($con,$sql2);
                  $row2=mysqli_fetch_assoc($result2);
                  $num2 = mysqli_num_rows($result2);


                  $sql3 = "SELECT * FROM FOLLOW WHERE user_id='$user_id' and u_id='$uid' and is_accepted='1'";
                  $result3=mysqli_query($con,$sql3);
                  $row3=mysqli_fetch_assoc($result3);
                  $num3 = mysqli_num_rows($result3);

                  $sql4 = "SELECT * FROM FOLLOW WHERE user_id='$uid' and u_id='$user_id' and is_accepted='1'";
                  $result4=mysqli_query($con,$sql4);
                  $row4=mysqli_fetch_assoc($result4);
                  $num4 = mysqli_num_rows($result4);

                  $sql5 = "SELECT * FROM FOLLOW WHERE user_id='$uid' and u_id='$user_id' and is_accepted='0'";
                  $result5=mysqli_query($con,$sql5);
                  $row5=mysqli_fetch_assoc($result5);
                  $num5 = mysqli_num_rows($result5);

                  if(isset($_GET['me'])){?>
                    <a href="add_detail.php?uid=<?php echo $uid ?>" class="btn btn-success btn-block"><b>Edit Profile</b></a>
                  <?php
                  }
                  else{
                    if($num4==1){
                      $_SESSION['unfollow'] = "1";?>
                      
                        <a href="con_follow.php?uid=<?php echo $uid?>" class="btn btn-secondary btn-block"><b>Disconnect</b></a>
                      <?php
                    }
                    else{
                      if($num1==0){
                        if($num5==1){?>
                        <a href="con_requests.php?do=1&uid=<?php echo $row['user_id'];?>&from=1" class="btn btn-success btn-block"><b>Accept</b></a>
                        <?php
                        }
                        else{?>
                          <a href="con_follow.php?uid=<?php echo $uid?>" class="btn btn-success btn-block"><b>Connect</b></a>
                          <?php
                        }
                        ?>
                        
                      <?php 
                    
                    }
                      else if($num2==1){
                        $_SESSION['pending'] = "1";
                      ?>
                        <a href="con_follow.php?uid=<?php echo $uid?>" class="btn btn-secondary btn-block"><b>Pending</b></a>
                      <?php }
                      else if($num3==1){
                        $_SESSION['unfollow'] = "1";?>
                          <a href="con_follow.php?uid=<?php echo $uid?>" class="btn btn-secondary btn-block"><b>Disconnect</b></a>
                        <?php }
                    }
                  } 
                ?>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-warning bg-gradient">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                <?php echo $row['education'];?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?php echo $row['current_location'];?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger"><?php echo $row['skills'];?></span>
                </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
                 
              <div class="card-header p-2">
               <p style="margin-left:10px;margin-bottom:0px;font-size:160%;"><b>Activity</b></p>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">
                  <?php 
                  if(isset($_GET['me'])){
                    $sql5 = "SELECT * from post where user_id='$user_id'";
                  }
                  else{
                    $sql5 = "SELECT * from post where user_id='$uid'";
                  }
                  $result5=mysqli_query($con,$sql5);
                  $num5 = mysqli_num_rows($result5);
                  // echo $sql5;
                  if($num5>=1){
                      $row5=mysqli_fetch_assoc($result5);
                  ?>  
                  <div class="active tab-pane" id="activity">
                    <!-- Post --><?php
                    if (isset($_GET['me'])) {
                      $sql1 = "SELECT * from post INNER JOIN post_file ON post.post_id=post_file.post_id  where user_id='$user_id' order by created_on DESC";
                    }
                    else {
                      $sql1 = "SELECT * from post INNER JOIN post_file ON post.post_id=post_file.post_id  where user_id='$uid' order by created_on DESC";
                    }
                    
                      $result1=mysqli_query($con,$sql1);
                      // echo $sql1;
                      $num1 = mysqli_num_rows($result1);
                      // echo $num1;
                      while($row1=mysqli_fetch_assoc($result1)){;
                        $pid=$row1['post_id'];?>
                      <div class="post">
                        <div class="user-block"><?php
                          if(isset($_GET['me'])){
                            $sql16 = "SELECT * from user where user_id='$user_id'";
                          }
                          else{
                            $sql16 = "SELECT * from user where user_id='$uid'";
                          }
                          $result16=mysqli_query($con,$sql16);
                          $row16 = mysqli_fetch_assoc($result16);
                          // echo $sql16;?>
                          <img class="img-circle img-bordered-sm" src="<?php if($row16['profile_picture']!=NULL){echo $row16['profile_picture'];}else{ echo "../dist/img/avatar5.png";}?>" alt="user image">
                          <span class="username">
                            <a href="#" style="color:#03599E;"><?php 
                              if(isset($_GET['me'])){
                                $sql2 = "SELECT * from user where user_id='$user_id'";
                              }
                              else{
                                $sql2 = "SELECT * from user where user_id='$uid'";
                              }
                              $result2=mysqli_query($con,$sql2);
                              $row2=mysqli_fetch_assoc($result2);
                              echo $row2['fname'].' '.$row2['lname'];?></a>
                            <?php 
                              if(isset($_GET['me'])){?>
                                <a href="javascript:delete_post(<?php echo $pid; ?>)" class="float-right btn-tool"><i class="fas fa-trash-alt"></i></a> 
                              <?php 
                              }
                            ?>
                             <?php 
                              if(isset($_GET['me'])){?>
                            <a href="con_edit_post.php?pid=<?php echo($pid); ?>" class="float-right btn-tool"><i class="fas fa-edit"></i></a>
                            <?php 
                              }
                            ?>
                            
                          </span>
                          <span class="description"><?php echo $row5['created_on'];?></span>
                          
                        </div>
                      
                      <!-- /.user-block -->
                      <p><?php
                      

                      
                      echo $row1['post_desc'];
                      ?>
                      </p>
                      <center><div><?php 
                      if(strpos($row1['file_path'], "mp4")==true){?>
                        <video width="100%" controls>
                        <source src="<?php $row1['file_path']?>" type="video/mp4">
                       
                      </video>
                      <?php
                      }
                      else{
                      ?>
                      <img class="img-fluid pad" width="50%" src="<?php echo $row1['file_path'];?>" alt="Photo"></div></center><br>
                      <?php }?>
                      <p>
                      <?php 
                          $sql7 = "SELECT * FROM likes where post_id='$pid' and u_id='$user_id'";
                          $result7=mysqli_query($con,$sql7);
                          $num7 = mysqli_num_rows($result7);
                          // echo $num7;
                          // echo $sql7;?>
                          <button type="button" id="dislikebtn<?php echo($pid); ?>" class="btn btn-default btn-sm <?php  if ($num7 == 0) {echo('d-none');} ?>" onclick="setDislike(<?php echo $pid; ?>)"><i class="fas fa-thumbs-up"></i> Like</button>
                      
                        <button type="button" id="likebtn<?php echo($pid); ?>" class="btn btn-default btn-sm <?php  if ($num7 >= 1) {echo('d-none');} ?>" onclick="setlike(<?php echo $pid; ?>)"><i class="far fa-thumbs-up"></i> Like</button>
                          
                      
                        
                        
                        <span class="float-right text-muted" id="postLikes<?php echo($pid); ?>">
                          <span class="float-right text-muted"><?php
                          $sql8 = "SELECT * FROM likes where post_id='$pid'";
                          $result8=mysqli_query($con,$sql8);
                          $num8 = mysqli_num_rows($result8);
                          //  echo $sql8;
                            echo $num8;?> Likes<?php 
                          
                            $sql6 = "SELECT * from comments where post_id='$pid'";
                            
                              $result6=mysqli_query($con,$sql6);
                              $row6 = mysqli_fetch_assoc($result6);
                              $num6 = mysqli_num_rows($result6);
                              // echo $num6;
                          
                          ?></span>
                      </p>
                      
                      <div class="card-footer card-comments">
                      
                      <?php
                          $sql26 = "SELECT * from user INNER JOIN comments ON user.user_id=comments.u_id where post_id='$pid' order by comment_id desc";
                          
                          $result26=mysqli_query($con,$sql26);
                          
                          
                          // echo $sql7;
                          
                          while($row26=mysqli_fetch_assoc($result26))
                          {
                            $uid1 = $row26['u_id'];
                            $sql261 = "SELECT * from user  where user_id='$uid1'";
                            $result261=mysqli_query($con,$sql261);
                            $row261=mysqli_fetch_assoc($result261);
                            // echo $sql261;
                            ?>
                          <img class="img-fluid img-circle img-sm" src="<?php if($row261['profile_picture']!=NULL){echo $row261['profile_picture'];}else{ echo "../dist/img/avatar5.png";}?>" alt="Alt Text">
                            <div class="comment-text"><?php 
                            
                            // echo $sql26;
                            ?>
                            
                              <span class="username" style="color:#03599E;">
                              
                                <?php 
                                
                                if($row261['fname'] != '' && $row261['lname']!='') {
                                  echo $row261['fname']." ".$row261['lname'];
                                }
                                else {
                                  echo $row261['username'];
                                }
                                ?>
                                <span class="text-muted float-right"><?php echo $row26['created_on'];?></span>
                              </span><!-- /.username -->
                              <?php 
                              
                              // echo $sql5;
                              echo $row26['description'];
                              ?>
                            </div>
                            <!-- /.comment-text -->
                            
                            <?php
                          }?>
                          </div>
                          <span class="text-muted float-left" id="postComment<?php echo($pid); ?>"></span>
                <div class="card-footer">
                  
                <img class="img-fluid img-circle img-sm" src="<?php if ($row111['profile_picture'] != null) {
                                                                        echo $row111['profile_picture'];
                                                                      } else {
                                                                        echo "../dist/img/avatar5.png";
                                                                      } ?>" alt="Alt Text">
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push">
                    <div class="container">
                        <div class="row">
                          
                          <input type="text" 
                          id="commentContent" class="form-control form-control-sm mr-2 md-form" style="width:76%" placeholder="Press enter to post comment" name="comment">
                          
                          <button type="button" id="likebtn<?php echo($pid); ?>" class="btn btn-sm responsive-width" onclick="setComment(<?php echo $pid; ?>)" style="background:#E64B3B; color:white;"> Enter</button>
                        </div>
                      </div>
                      </div>
                  
                </div>   
                      <!-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment" name="comment"> -->
                    </div>
                  <?php
                  }?>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
              <?php 
              }
                  
              ?>
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<?php
  require("parts/footer.php");
?>
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
    var commentContent = document.getElementById('commentContent').value;
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

  function delete_post(pid) {
    confirm("Are you sure you want to delete?");
    window.location.href = "con_delete_post.php?pid="+pid;
  }
  </script>
</body>
</html>