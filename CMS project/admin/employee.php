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
                            <td>Image</td>
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
                                      <a href=""><i class="fa fa-edit"></i></a>
                                    </li>
                                    <li>
                                      <a href=""><i class="fa fa-trash"></i></a>
                                    </li>
                                  </ul>
                                </div>
                              </th>
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

             else if($do == 'Store'){
                echo "We will store the data of our new employee in DB";
             }
             else if($do == 'Edit'){
                echo "This is our edit user HTML page";
             }
             else if($do == 'Update'){
                echo "This is our update user HTML page";
             }
             else if($do == 'Delete'){
                 echo "We will delete the users";
             }
            
            ?>

           </div>
       </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
 
<?php
   include "inc/footer.php";
?>