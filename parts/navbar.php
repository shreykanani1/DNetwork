<?php
require 'db_config.php';
if(!isset($_SESSION['user_id'])){
  header("Location: index.php");
}
$user_id = $_SESSION['user_id'];
?>
<!-- Navbar -->
<link rel="favicon" type="image/jpg" href="../img/favicon.ico"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a href="welcome.php" class="nav-link"><i class="fas fa-home"></i></a>
    </li>
  </ul>


  
  <!-- SEARCH FORM -->
  <form class="form-inline mr-3" action="accounts.php" method="post" style="margin: 0 auto;
    display: inline-block;">
    <div class="input-group input-group-sm " >
      <input class="form-control form-control-navbar " type="text" name="searchAccount" id="searchAccount" placeholder="Search" aria-label="Search" required>
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>

  <!-- Right navbar links -->
  <ul class="navbar-nav">
    <li>
      <a class="nav-link" href="requests.php">
        <i class="far fa-user"></i>
        <span class="badge badge-primary navbar-badge">
          <?php
            session_start();
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM follow
            INNER JOIN user
            ON follow.u_id=user.user_id
            where follow.u_id='$user_id' and is_accepted='0'";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            echo $num;
          ?>
        </span>
      </a>
    </li>
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" href="message_home.php">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">
        <?php 
          $sql2 = "SELECT * FROM messages where user_id!='$user_id' and is_seen = 0";
          // echo $sql2;
          $result2=mysqli_query($con,$sql2);
          // header("Location: message.php");
         
          $num = mysqli_num_rows($result2);
          echo $num;
        ?>
        </span>
      </a>
      
    </li>
    <!-- Notifications Dropdown Menu -->


  </ul>
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
<!-- /.navbar -->