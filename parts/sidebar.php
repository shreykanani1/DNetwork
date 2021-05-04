  <?php 
    session_start();
    error_reporting(0);
    $user_id=$_SESSION['user_id'];
    $sql = "SELECT * FROM user where user_id='$user_id'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
  ?>
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="welcome.php" class="brand-link">
      <img src="img/dnetwork_logo.png" alt="AdminLTE Logo" style="width: 120px;margin-left: 61px;">
      <span class="brand-text font-weight-light"> </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php
        $sql6 = "SELECT * from user where user_id='$user_id'";
        $result6=mysqli_query($con,$sql6);
        $row6 = mysqli_fetch_assoc($result6);
        ?>
          <img src="<?php if($row6['profile_picture']!=NULL){echo $row6['profile_picture'];}else{ echo "../dist/img/avatar5.png";}?>" class="img-circle img-bordered-sm" alt="User Image">
        </div>
        <div class="info">
        <a href="profile.php?uid=<?php echo $user_id;?>&me=1" class="d-block">
        <?php
        if($row['fname'] != '' && $row['lname']!='') {
          echo $row['fname']." ".$row['lname'];
        }
        else {
          echo $row['username'];
        }
          
          
          
          ?></a>
          
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="developers.php" class="nav-link">
              <i class="nav-icon fas fa-code"></i>
              <p>Developers</p>
            </a>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_detail.php" class="nav-link">
                  <i class="nav-icon fas fa-pen" style="color:#41BBFF"></i>
                  <p>Edit Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="delete_account.php" class="nav-link">
                  <i class="nav-icon fas fa-trash-alt" style="color:tomato;"></i>
                  <p>Delete Account</p>
                </a>
              </li>
              
            </ul>
          </li>


          
          

          

          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p onclick="return confirm('Are you sure you want to Logout?');">
                Logout
              </p>
            </a>
            </li>
            
          <!-- <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.0/" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li> -->
        </ul>
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
  function someFunction(){
    <?php 
      $_SESSION['me']=1;
      ?>
      location.href = "profile.php?uid=<?php echo $user_id;?>";
  }


  </script>