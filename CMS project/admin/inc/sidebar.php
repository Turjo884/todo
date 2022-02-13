 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
          
          $user_id = $_SESSION['id'] ;

          $sql = "SELECT * FROM users WHERE id = '$user_id'";
          $readData = mysqli_query($db, $sql);

          while( $row = mysqli_fetch_assoc($readData)){
            $image = $row['image'];

            if(!empty($image) ){
              ?>
                <img src="dist/img/users/<?php echo $image ;?>" class="img-circle elevation-2" alt="User Image">
              <?php
            }
            else{
              echo "no image found";
            }
          }
          
          ?>
        
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['name'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">To Do Application</li>
          
          
        
          <?php
          // this php is for not to get access the employee in employee.php page
          if($_SESSION['role'] == 0){
            ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                All Employee List
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="employee.php?do=Add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add new employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="employee.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage all employee</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                All Employee Working List
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="task.php?do=Add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add new task</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="task.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage all task</p>
                </a>
              </li>
            </ul>
          </li>

            <?php
          }
          ?>

          <!-- For Individual Employee -->
          <?php
            if($_SESSION['role'] == 1){
              ?>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    My Working List
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="self.php?do=Add" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add new task</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="self.php?do=Manage" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage all task</p>
                    </a>
                  </li>
                </ul>
              </li>

              <?php
            }
          ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>