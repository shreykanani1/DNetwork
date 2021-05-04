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
  <title>Developers | DNetwork</title>
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
                <li class="breadcrumb-item active">Developers</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->



      <!-- main content -->
      <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
        <h3 style = "font-family:verdana,garamond,serif;font-style:bold;">Developers</h3><br>
          <div class="row d-flex align-items-stretch">
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  PHP Developer
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Shrey Kanani</b></h2>
                      <p class="text-muted text-sm"><b>About: </b> Web Developer / Backend enthusiast / Photographer</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <b>Address:</b> Rajkot, Gujarat, INDIA.</li>
                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> <b>Phone #:</b> + 91 - 81412 38368</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="uploadPostFile/photo_2020_1.jpg" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://www.linkedin.com/in/shreykanani99" class="btn btn-sm " target="_blank" style="background:#0077b5; color:white;">
                      <i class="fab fa-linkedin-in"></i>
                    </a>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  PHP Developer
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Henish Patadiya</b></h2>
                      <p class="text-muted text-sm"><b>About: </b> Web Developer</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <b>Address:</b> Morbi, Gujarat, INDIA.</li>
                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> <b>Phone #:</b> + 91 - 97268 07088</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="uploadPostFile/photo_2021-04-01_21-13-43.jpg" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://www.linkedin.com/in/henish-patadiya-99a1501a4?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BsjyXHafZRV%2BCYsYXFu6DgQ%3D%3D" class="btn btn-sm" target="_blank" style="background:#0077b5; color:white;">
                      <i class="fab fa-linkedin-in" ></i>
                    </a>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  PHP Developer
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Raj Kapuriya</b></h2>
                      <p class="text-muted text-sm"><b>About: </b> Web Developer</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <b>Address:</b> Rajkot, Gujarat, INDIA.</li>
                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> <b>Phone #:</b> + 91 - 97140 76813</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="uploadPostFile/photo_2021-04-01_21-07-17.jpg" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://www.linkedin.com/in/raj-kapuriya-405b85192?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3Bl07ra0u7QzqSj2XtQvuRXQ%3D%3D" class="btn btn-sm " target="_blank" style="background:#0077b5; color:white;">
                      <i class="fab fa-linkedin-in"></i>
                    </a>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->




      <div class="card card-solid">
        <div class="card-body pb-0">
        <h3 style = "font-family:verdana,garamond,serif;font-style:bold;">About <b>ASWDC</b></h3><br>
          <div class="row d-flex align-items-stretch">
            <div class="col-12 col-sm-4 col-md-4 d-flex align-items-stretch">
              
                <div class="card-header text-muted border-bottom-0" >
                  
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    
                    <div class="col-12 text-center">
                      <img src="img/aswdc.png" alt="" style="float: center;" width="85%">
                    </div>
                  </div>
                </div>
                
              
            </div>
            <div class="col-12 col-sm-8 col-md-8 d-flex align-items-stretch">
            <p class="card-text">The department is proud to announce its <a href="http://www.aswdc.in/" class="kt-link kt-link--dark g-color-black-opacity-0_9" target="_blank" title="App Software &amp; Website Development Center, Computer Engineering Department, Darshan Institute of Engineering &amp; Technology"><b><i>"ASWDC - Apps, Software &amp; Website Development Center"</i></b></a>. The center fulfills software &amp; website requirements of the College.
            Sole purpose of ASWDC is to bridge gap between university curriculum &amp; industry demands. Students learn cutting edge technologies, develop real world applications &amp; experiences proffesional environment @ ASWDC under guidance of industry experts &amp; faculty members. <br><br><b>Mentored By</b> : <b><a href="http://www.darshan.ac.in/DIET/Faculty/Prof-Arjun-Virjibhai-Bala" target="_blank"> Prof. Arjun V. Bala</a></b> , Computer engineering department. <br><b>Explored By</b> : ASWDC, Computer engineering department. <br><b>Eulogized By</b> : <a href="https://www.darshan.ac.in/" target="_blank"> <b>Darshan Institute of Engineering & Technology.</a></b> <br></p><br>

            
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer -->
      </div>

    </section>
    </div>
 
</body>
<?php
  require "parts/footer.php";
  ?>
</html>