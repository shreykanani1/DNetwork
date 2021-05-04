<?php
session_start();
error_reporting(0);
require 'parts/db_config.php';

// for sign in with google
include '../vendor/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Delete Account | DNetwork</title>
  <link rel="icon" type="image/jpg" href="img/favicon-16x16.png"/>
  <?php
  require "parts/css_js.php";
  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed" >
  <div class="wrapper" >
    <?php
    require "parts/navbar.php";
    require "parts/sidebar.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-image: url(bgsocial3.jpg);background-repeat: repeat-x;
  background-attachment: fixed;
">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              
            </div><!-- /.col -->
            <div class="col-sm-2">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="welcome.php">Home</a></li>
                <li class="breadcrumb-item active">Delete Account</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->



      <!-- main content -->
      <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-body">
                <h3>Tell us why you’re closing your account:</h3>
                <select name="reason" id="reason" class="form-control" required>
                    <option value="-1" selected>----Select Reason----</option>
                    <option value="I have a duplicate account">I have a duplicate account</option>
                    <option value="I’m getting too many emails">I’m getting too many emails</option>
                    <option value="I’m not getting any value from my membership">I’m not getting any value from my membership</option>
                    <option value="I have a privacy concern">I have a privacy concern</option>
                    <option value="I’m receiving unwanted contact">I’m receiving unwanted contact</option>
                    <option value="Other" >Other</option>
                </select>
                <br>
                <h3>We value your feedback</h3>
                <textarea name="feedback" id="feedback" cols="30" rows="5" class="form-control" placeholder="Enter feedack here"></textarea>
                <br>

                <div class="form-group row">
                        <a href="con_delete_account.php" class="btn mr-2 ml-2" role="button" style="background:#E64B3B; color:white;">Delete</a>
                        <a href="welcome.php" class="btn btn-default" role="button">Cancel</a>
                </div>
            </div>
            </div>
        </div>
      </section>
    </div>
 
</body>
<?php
  require "parts/footer.php";
  ?>
</html>