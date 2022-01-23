<?php
  include "inc/header.php";
?>
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blank Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage all employee</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

    <!-- This Php code for so that no employee can enter through link in employee.php page -->
    <?php
    
    if($_SESSION['role'] == 0){
      ?>

    <div class="container-fluid">
       <div class="row">
           <div class="col-lg-12">


            <?php
            
            //  if(isset($_GET['do'])){
            //     $do = $_GET['do'];
            //  }

            //  Ternary condition
            $do = (isset($_GET['do'])) ? $_GET['do'] : 'Manage';

            // All employee lists Start
             if($do == 'Manage'){
               ?>

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title mb-2">Manage Employee</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                  <table class="table">
                      <thead class="table table-dark">
                        <tr>
                          <th scope="col">#Sl</th>
                          <th scope="col">Image</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Designation</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Role</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>


                        <?php
                        
                        $sql = "SELECT * FROM users WHERE role = 1";
                        $readEmployee = mysqli_query($db, $sql);

                        $countEmployee = mysqli_num_rows($readEmployee);
                        $s = 0;

                        if($countEmployee > 0){
                          while($row = mysqli_fetch_assoc($readEmployee)){
                            $id          = $row['id'];
                            $name        = $row['name'];
                            $email       = $row['email'];
                            $designation = $row['designation'];
                            $phone       = $row['phone'];
                            $adress      = $row['adress'];
                            $role        = $row['role'];
                            $status      = $row['status'];
                            $image       = $row['image'];
                            $join_date   = $row['join_date'];
                            $s++;

                            ?>

                            <tr>
                            <th><?php echo $s ?></th>
                            <td><?php
                            
                            if(!empty($image)){
                              ?>

                              <img src="dist/img/users/<?php echo $image; ?>" alt="" class="employee-img">

                            <?php
                            }
                            else{
                              echo "Not uploaded";
                            }
                            ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $email ?></td>
                            <th><?php echo $designation ?></th>
                            <td><?php echo $phone ?></td>
                            <td>
                              <?php 
                              
                              if($role == 0){
                                ?>
                                  <span class="badge badge-success">Super Admin</span>
                                <?php
                              }
                              else if($role == 1){
                                ?>
                                    <span class="badge badge-primary">Employee </span>
                                <?php
                              }
                              
                              ?>
                            </td>
                            <td>

                            <?php 
                              
                              if($status == 0){
                                ?>
                                  <span class="badge badge-danger">Inactive</span>
                                <?php
                              }
                              else if($status == 1){
                                ?>
                                    <span class="badge badge-info">Active</span>
                                <?php
                              }
                              
                              ?>

                            </td>

                              <th>
                                <div class="action-links">
                                  <ul>
                                    <li>
                                      <a href="employee.php?do=Edit&id=<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                    </li>
                                    <li>
                                      <a href=""  data-toggle="modal" data-target="#delete<?php echo $id; ?>"><i class="fa fa-trash"></i></a>
                                    </li>
                                  </ul>
                                </div>
                              </th>

                                <!-- Delete Employee Modal -->
                                <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you really want to delete this Employee?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="modal-conformation">
                                          <ul>
                                            <li>
                                              <a href="employee.php?do=Delete&id=<?php echo $id; ?>" class="btn btn-danger">Confirm</a>
                                            </li>
                                            <li>
                                            <a href="employee.php?do=Delete&id=<?php echo $id; ?>" class="btn btn-success">Cancel</a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              </tr>

                            <?php
                          }
                          ?>

                         <?php
                        }
                        else{
                          ?>
                            <div class="alert alert-danger mt-4">No Employee Data Record Found</div>
                          <?php
                        }
                        ?>

                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

               <?php 
             }
            //End All Employee List End

            //Start Add New employee 
             else if($do == 'Add'){
              ?>

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title mb-2">Add New Employee</h3>
                  </div>
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form action="employee.php?do=Store" method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Full Name</label>
                            <input type="name" class="form-control" name="name" required="required">
                          </div>

                          <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="email" required="required">
                          </div>

                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required="required">
                          </div>

                          <div class="form-group">
                            <label>Re-password</label>
                            <input type="password" class="form-control" name="repassword" required="required">
                          </div>

                          <div class="form-group">
                            <label>Phone</label>
                            <input type="phone" class="form-control" name="phone">
                          </div>

                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address">
                          </div>

                          <div class="form-group">
                            <label>Designation</label>
                            <input type="text" class="form-control" name="designation" required="required">
                          </div>

                          <div class="form-group">
                            <label>User Role</label>
                              <select name="role" class="form-control">
                                <option value="1">Please Select Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Employee</option>
                              </select>
                          </div>

                          <div class="form-group">
                            <label>Status</label>
                              <select name="status" class="form-control">
                                <option value="1">Please Select Status</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                              </select>
                          </div>

                          <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control-file">
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <input type="submit" name="register" class="btn btn-info btn-block btn-flat" value="Register New User">
                        </div>
                      </div>
                    </form>
                  
                  </div>
                </div>

              <?php
             }

            //End Add New employee

            // Start Employee Store
             else if($do == 'Store'){
               if(isset($_POST['register'])){
                
                $name         = $_POST['name']; 
                $email        = $_POST['email']; 
                $password     = mysqli_real_escape_string($db, $_POST['password']); 
                $repassword   = mysqli_real_escape_string($db, $_POST['repassword']);
                $phone        = $_POST['phone'];
                $address      = mysqli_real_escape_string($db, $_POST['address']); 
                $designation  = $_POST['designation']; 
                $role         = $_POST['role']; 
                $status       = $_POST['status'];
                $image        = $_FILES['image']['name'];
                $image_tmp    = $_FILES['image']['tmp_name'];

                if($password == $repassword){
                  $hassedPassword = sha1($password);

                  // If Image Found
                  if(!empty($image)){

                    $imageName = rand(1,99999999) .  "-employee-" . $name;
                    move_uploaded_file($image_tmp, "dist/img/users/" . $imageName);

                    $sql ="INSERT INTO users (name, email, password, designation,phone, adress, role, status, image, join_date) VALUES ('$name', '$email', '$hassedPassword', '$designation', '$phone', '$address', '$role', '$status', '$imageName', now())";

                    $addEmployee = mysqli_query($db, $sql);

                    if($addEmployee){
                      header("Location: employee.php?do=Manage");
                    }
                    else{
                      die("Mysqli Query Failed." . mysqli_error($db));
                    }

                  } 
                  // If Image Not Found
                  else{

                    $sql ="INSERT INTO users (name, email, password, designation, phone, adress, role, status, join_date) VALUES ('$name', '$email', '$hassedPassword', '$designation', '$phone', '$address', '$role', '$status', now())";

                    $addEmployee = mysqli_query($db, $sql);

                    if($addEmployee){
                      header("Location: employee.php?do=Manage");
                    }
                    else{
                      die("Mysqli Query Failed." . mysqli_error($db));
                    }

                  }
                }
               }
             }
            // End Employee Store

            // Start Edit Section
             else if($do == 'Edit'){
                if(isset($_GET['id'])){
                  $user_id = $_GET['id'];

                  $sql = "SELECT * FROM users WHERE id = '$user_id'";
                  $readData = mysqli_query($db, $sql);
                  while($row = mysqli_fetch_assoc($readData)){

                    $id          = $row['id'];
                    $name        = $row['name'];
                    $email       = $row['email'];
                    $designation = $row['designation'];
                    $phone       = $row['phone'];
                    $adress      = $row['adress'];
                    $role        = $row['role'];
                    $status      = $row['status'];
                    $image       = $row['image'];
                    // $join_date   = $row['join_date'];
                    ?>
                    
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title mb-2">Update Employee Information</h3>
                      </div>
                  
                      <!-- /.card-header -->
                      <div class="card-body">
                        <form action="employee.php?do=Update" method="POST" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label>Full Name</label>
                                <input type="name" class="form-control" name="name" required="required" value="<?php echo $name;?>">
                              </div>

                              <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" required="required" value="<?php echo $email;?>">
                              </div>

                              <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="*****">
                              </div>

                              <div class="form-group">
                                <label>Re-password</label>
                                <input type="password" class="form-control" name="repassword" placeholder="*****">
                              </div>

                              <div class="form-group">
                                <label>Phone</label>
                                <input type="phone" class="form-control" name="phone" value="<?php echo $phone;?>">
                              </div>

                            </div>

                            <div class="col-lg-6">
                              <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" value="<?php echo $adress?>">
                              </div>

                              <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation" required="required" value="<?php echo $designation?>">
                              </div>

                              <div class="form-group">
                                <label>User Role</label>
                                  <select name="role" class="form-control">
                                    <option value="1">Please Select Role</option>
                                    <option value="0"<?php if($role == 0){
                                      echo 'selected';}?>>Admin</option>
                                    <option value="1" <?php if($role == 1){
                                      echo 'selected';}?>>Employee</option>
                                  </select>
                              </div>

                              <div class="form-group">
                                <label>Status</label>
                                  <select name="status" class="form-control">
                                    <option value="1">Please Select Status</option>
                                    <option value="0" <?php if($status == 0){echo 'selected';}?>>Inactive</option>
                                    <option value="1" <?php if($status == 1){echo 'selected';}?>>Active</option>
                                  </select>
                              </div>

                              <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control-file">
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group">
                                <input type="hidden" name="userid" value="<?php echo $id;?>">
                                <input type="submit" name="updateUser" class="btn btn-info btn-block btn-flat" value="Update Employee Information">
                              </div>
                            </div>
                          </div>
                        </form>
                      
                      </div>
                    </div>

                 <?php }

                }
             }

            //  Start Update Section
              else if($do == 'Update'){
                if(isset($_POST['updateUser'])){
                  $userid = $_POST['userid'];
                 
                  $name         = $_POST['name']; 
                  $email        = $_POST['email']; 
                  $password     = mysqli_real_escape_string($db, $_POST['password']); 
                  $repassword   = mysqli_real_escape_string($db, $_POST['repassword']);
                  $phone        = $_POST['phone'];
                  $address      = mysqli_real_escape_string($db, $_POST['address']); 
                  $designation  = $_POST['designation']; 
                  $role         = $_POST['role']; 
                  $status       = $_POST['status'];
                  $image        = $_FILES['image']['name'];
                  $image_tmp    = $_FILES['image']['tmp_name'];

                  // Both for Password and Image
                  if(!empty($password) && !empty($image)){

                    // password encrypted
                    if($password == $repassword){
                      $hassedPass = sha1($password);

                      // Delete old Image
                      $oldImage = "SELECT * FROM users WHERE id = '$userid'";
                      $getImageName = mysqli_query($db, $oldImage);
                      while($row = mysqli_fetch_assoc($getImageName)){
                        $theOldImage = $row['image'];
                      }

                      unlink("dist/img/users/" . $theOldImage);

                      // Upload New Image
                      $imageName = rand(1,99999999) .  "-employee-" . $name;
                      move_uploaded_file($image_tmp, "dist/img/users/" . $imageName);

                      // Upload New Image
                      $imageName = rand(1,99999999) .  "-employee-" . $name;
                      move_uploaded_file($image_tmp, "dist/img/users/" . $imageName);

                      // Update Query
                      $sql ="UPDATE users SET name='$name', email='$email', password='$hassedPassword', designation='$designation',phone='$phone', adress='$address', role='$role', status='$status', image='$imageName' WHERE id ='$userid'";

                      $updateEmployee = mysqli_query($db, $sql);

                      if($updateEmployee){
                        header("Location: employee.php?do=Manage");
                      }
                      else{
                        die("Mysqli Query Failed." . mysqli_error($db));
                      }

                    }

                  }
                  // Only for Password
                  else if(!empty($password) && empty($image)){

                    // password encrypted
                    if($password == $repassword){
                      $hassedPass = sha1($password);

                      // Update Query
                      $sql ="UPDATE users SET name='$name', email='$email', password='$hassedPassword', designation='$designation',phone='$phone', adress='$address', role='$role', status='$status' WHERE id ='$userid'";

                      $updateEmployee = mysqli_query($db, $sql);

                      if($updateEmployee){
                        header("Location: employee.php?do=Manage");
                      }
                      else{
                        die("Mysqli Query Failed." . mysqli_error($db));
                      }

                    }

                  }
                  // Only for Image
                  else if(empty($password) && !empty($image)){

                      // Delete old Image
                      $oldImage = "SELECT * FROM users WHERE id = '$userid'";
                      $getImageName = mysqli_query($db, $oldImage);
                      while($row = mysqli_fetch_assoc($getImageName)){
                        $theOldImage = $row['image'];
                      }

                      unlink("dist/img/users/" . $theOldImage);

                      // Upload New Image
                      $imageName = rand(1,99999999) .  "-employee-" . $name;
                      move_uploaded_file($image_tmp, "dist/img/users/" . $imageName);

                      // Update Query
                      $sql ="UPDATE users SET name='$name', email='$email',designation='$designation',phone='$phone', adress='$address', role='$role', status='$status', image='$imageName' WHERE id ='$userid'";

                      $updateEmployee = mysqli_query($db, $sql);

                      if($updateEmployee){
                        header("Location: employee.php?do=Manage");
                      }
                      else{
                        die("Mysqli Query Failed." . mysqli_error($db));
                      }

                  }
                  // None of them available
                  else{

                     // Update Query
                     $sql ="UPDATE users SET name='$name', email='$email',designation='$designation',phone='$phone', adress='$address', role='$role', status='$status' WHERE id ='$userid'";

                     $updateEmployee = mysqli_query($db, $sql);

                     if($updateEmployee){
                       header("Location: employee.php?do=Manage");
                     }
                     else{
                       die("Mysqli Query Failed." . mysqli_error($db));
                     }

                  }

                }
             }
             else if($do == 'Delete'){
                if(isset($_GET['id'])){

                  $deleteId = $_GET['id'];
                  
                  $sql = "DELETE FROM users WHERE id = $deleteId";
                  $deleteUser = mysqli_query($db, $sql);

                  if($deleteUser){
                    header("Location: employee.php?do=Manage");
                  }
                  else{
                    die("Mysqli Query Failed." . mysqli_error($db));
                  }
                } 
                
             }
            
            ?>

           </div>
       </div>
      </div><!--/. container-fluid -->

     <?php
    }
    else{
     
      echo '<div class="alert alert-danger">Sorry!!! you have no access to this page.</div>';
     
    }
     ?>

    </section>
    <!-- /.content -->
 
<?php
   include "inc/footer.php";
?>