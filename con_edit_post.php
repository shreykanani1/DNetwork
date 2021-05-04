<?php 
session_start();
error_reporting(0);
require 'parts/db_config.php';
include 'parts/css_js.php';
include 'parts/CommonFunctions.php';

$pid = $_GET['pid'];
$user_id = $_SESSION['user_id'];


if($_SERVER['REQUEST_METHOD']=='POST'){
    $postdesc = $_POST['postdesc'];
    $sql1 = "UPDATE post SET post_desc='$postdesc' WHERE post_id=$pid;";
    $result1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_assoc($result1);
    // echo $sql1;
    header("Location: welcome.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Project Add</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'parts/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'parts/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Post</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    <section class="content">
    <form method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            
                <div class="card-body">
                    <!-- <div class="form-group">
                        <label for="inputName">Type of Post</label>
                        <input type="text" id="inputName" class="form-control">
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="inputStatus">Type of Post</label>
                        <select class="form-control custom-select">
                        <option selected disabled>Select one</option>
                        <option>Text</a></option>
                        <option>Image</option>
                        <option>Video</option>
                        </select>
                    </div> -->
                    <?php
                      $sql = "SELECT * FROM post WHERE post_id=$pid;";
                      $result = mysqli_query($con,$sql);
                      $row = mysqli_fetch_assoc($result);
                    //   echo $sql;
                    ?>
                    <div class="form-group">
                        <label for="postdesc">Post Description</label>
                        <input type=text id="postdesc" class="form-control" name="postdesc" value="<?php echo $row['post_desc'] ?>" required></input>
                    </div>
                    
                    
                    <!-- <div class="form-group">
                        <label for="inputProjectLeader">Project Leader</label>
                        <input type="text" id="inputProjectLeader" class="form-control">
                    </div> -->
                </div>
            
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
      <div class="row">
        <div class="col-12">
          <input type="submit" value="Post" class="btn btn-primary">&nbsp;
          <a href="welcome.php" class="btn btn-secondary">Cancel</a>
          
        </div>
      </div>
      </form>
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include 'parts/footer.php';?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
