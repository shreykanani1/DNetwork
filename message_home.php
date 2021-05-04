<?php 
  session_start();
  error_reporting(0);
  $uid = $_GET['uid'];
  $user_id=$_SESSION['user_id'];
  
  include 'parts/db_config.php';
  $username = $_SESSION['username'];

  if(isset($_POST['submit'])){
    $text = $_POST['text'];
    $sql = "SELECT * FROM follow where (user_id='$user_id' or u_id='$user_id') and is_accepted=1";
    $result = mysqli_query($con, $sql);
    // echo $sql;
    $user_id_arr = array();
    $user_all = "";
    while ($row = mysqli_fetch_assoc($result)) {
      if($row['user_id']==$user_id){
        $u_id = $row['u_id'];
      }
      else{
          $u_id=$row['user_id'];
      }
    
   
        $sql1 = "SELECT * FROM USER WHERE user_id = '$u_id' and username like '$text%'";
        $result1=mysqli_query($con,$sql1);
        $row1=mysqli_fetch_assoc($result1);
        if (mysqli_num_rows($result1)>0) {
          array_push($user_id_arr,$row1['user_id']);
        }
        
        


    }
    $user_id_arr = array_unique($user_id_arr);
        // echo $sql1;
        // print_r($user_id_arr);
        
        foreach ($user_id_arr as $value) {
          $user_all = $user_all . $value . ",";
        }
        $user_all = rtrim($user_all, ", ");
        // echo $user_all;
  }
  else {
    
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Messages | DNetwork</title>
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
            <h1 class="m-0 text-dark">Messages </h1>
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
<?php 
  $sql = "SELECT * FROM user where user_id='$uid' and verification_status=1";
   $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
    // echo $sql;
    ?>
    
    
    <!-- Main content -->
    <section class="content ">

      <!-- Default box -->
      <div class="card shadow-lg  mb-5 bg-white rounded">
        <div class="card-header">
          
          <form class="form-inline" method="post" style="margin: 0 auto; display: inline-block; ">
            <div class="form-group">
            <input type="text" name='text'class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search Account" style="margin-right: 10px;">
            <input type="submit" name='submit' class="btn btn-secondary" value="Search">
            </div>
            
          </form>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            
          </div>
        </div>
        <div class="card-body p-0 ">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      
                      <th style="width: 100%">
                          Connection
                      </th>
                  </tr>
              </thead>
              <tbody>
              
                <?php 
                $user_id = $_SESSION['user_id'];
                if(isset($_POST['submit'])){
                  $sql8 = "SELECT * from follow where user_id in ($user_all) or u_id in ($user_all) and is_accepted=1";
                }
                else {
                  $sql8 = "SELECT * from follow where user_id = '$user_id' or u_id ='$user_id' and is_accepted=1";
                }

                
                $result8 = mysqli_query($con, $sql8);
                $num8 = mysqli_num_rows($result8);
                // echo $sql8;
                while ($row8 = mysqli_fetch_assoc($result8)) {
                    if($row8['user_id']==$user_id){
                        $u_id = $row8['u_id'];
                    }
                    else{
                        $u_id=$row8['user_id'];
                    }
                    
                   
                        $sql = "SELECT * FROM USER WHERE user_id = '$u_id'";
                        $result=mysqli_query($con,$sql);
                        // echo $sql;
                        $row=mysqli_fetch_assoc($result);
                        $userid= $row['user_id'];
                        
                           
                    //     ?>
                    
                        <tr>
                     
                      <td>
                          <ul class="list-inline">
                              <li >
                                <img class="img-fluid img-circle img-sm" src="<?php if ($row['profile_picture'] != null) {
                                                                        echo $row['profile_picture'];
                                                                      } else {
                                                                        echo "../dist/img/avatar5.png";
                                                                      } ?>" alt="Alt Text">
                              </li>
                             
                          </ul>
                      
                      
                          <a href="message.php?uid=<?php echo $u_id;?>" style="color:black;margin-left: 12px;">
                              <?php if($row['fname'] != '' && $row['lname']!='') {
                                      echo $row['fname']." ".$row['lname'];
                                    }
                                    else {
                                      echo $row['username'];
                                    }?>

                          </a>
                          <?php 
                                $sql12 = "SELECT * FROM messages where user_id = $userid and is_seen = 0";
                                // echo $sql12;
                                $result12=mysqli_query($con,$sql12);
                                // header("Location: message.php");
                               
                                $num = mysqli_num_rows($result12);
                                // echo $num;
                          ?>
                           <?php 
                          if ($num > 0) {?>
                            <span class="right badge badge-danger"><?php
                            echo $num . ' New Message';?> </span>
                          <?php }
                          ?>
                          
                          

                          
                         
                      </td>

                  </tr>
                  
                   <?php 
                }?>
                
                
                  
              </tbody>
              
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<?php
  require("parts/footer.php");
?>
</body>
</html>