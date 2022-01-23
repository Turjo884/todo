<?php
  include "inc/header.php";
?>
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Todo List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Task Page</li>
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
                
                // Ternary Condition

                $do = (isset($_GET['do'])) ? $_GET['do'] : 'Manage';

                // All working list start

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
                          <th scope="col">Employee Name</th>
                          <th scope="col">Task Title</th>
                          <th scope="col">Timeline</th>
                          <th scope="col">Status</th>
                          <th scope="col">Note</th>
                          <th scope="col">Created At</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        
                        $sql ="SELECT * FROM todo ORDER BY id DESC";

                        $allTask = mysqli_query($db, $sql);

                        $numberofTask = mysqli_num_rows($allTask);

                        $i = 0;
                        if($numberofTask <= 0){
                            
                            echo '<div class="alert alert-danger">No data found</div>';
                            
                        }
                        else{

                            while($row = mysqli_fetch_assoc($allTask)){
                                $id            = $row['id'];
                                $user_id       = $row['user_id'];
                                $task_title    = $row['task_title'];
                                $description   = $row['description'];
                                $deadline      = $row['deadline'];
                                $status        = $row['status'];
                                $note          = $row['note'];
                                $created_at	   = $row['created_at'];
                                $i++ ;
                                ?>

                                <tr>
                                  <td><?php echo $i; ?></td>

                                  <td>
                                  <?php
                              
                                  $sql = "SELECT * FROM users WHERE id = '$user_id'";
                                  $employee = mysqli_query($db, $sql);

                                  while($row = mysqli_fetch_assoc($employee)){
                                    $id   = $row['id'];
                                    $name = $row['name'];
                                     
                                    echo $name;
                                  }
                                  ?>
                                  </td>

                                  <td>
                                  <?php
                              
                                  $sql = "SELECT * FROM users WHERE id = '$user_id'";
                                  $employee = mysqli_query($db, $sql);

                                  while($row = mysqli_fetch_assoc($employee)){
                                    $id   = $row['id'];
                                    $image = $row['image'];
                                    
                                    if(!empty($image)){
                                      ?>
        
                                      <img src="dist/img/users/<?php echo $image; ?>" alt="" class="employee-img">
        
                                    <?php
                                    }
                                    else{
                                      echo "Not uploaded";
                                    }
                                  }
                                  ?>
                                  </td>
                                  <td><?php echo $task_title; ?></td>
                                  <td><?php echo $deadline; ?></td>
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
                                  <td><?php echo $note; ?></td>
                                  <td><?php echo $created_at; ?></td>
                                  <td>

                                    <div class="action-links">
                                      <ul>
                                        <li>
                                          <a href="#"><i class="fa fa-edit"></i></a>
                                        </li>
                                        <li>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </li>
                                      </ul>
                                   </div>

                                  </td>
                                </tr>

                                <?php
                            }

                        }

                        ?>

                      </tbody>
                  </table>
                  </div>
                </div>

                    <?php
                }
                else if($do == 'Add'){
                  ?>

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title mb-2">Add New Employee</h3>
                  </div>
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form action="task.php?do=Store" method="POST">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Task Title</label>
                            <input type="text" class="form-control" name="task_title" placeholder="Please enter the task title">
                          </div>

                          <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" class="form-control" name="description" rows="7" placeholder="Please enter the description....."></textarea>
                          </div>

                          <div class="form-group">
                            <label>Task Deadline</label>
                            <!-- <input type="date" id="picker" class="form-control"> -->
                            <input type="text" name="daterange" value="12/01/2022 - 12/15/2022">
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Select Employee Name</label>
                            <select class="form-control" name="user_id">
                              <option>Please Select Employee Name</option>
                              <?php
                              
                              $sql = "SELECT * FROM users WHERE role = 1 ORDER BY name ASC";
                              $allEmployee = mysqli_query($db, $sql);

                              while($row = mysqli_fetch_assoc($allEmployee)){

                                $id = $row['id'];
                                $name = $row['name'];
                                ?>

                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                <?php 
                              }
                              ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                              <option value="1">Please Select Status</option>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Note</label>
                            <textarea type="text" class="form-control" name="note" rows="7" placeholder="Insert note here"></textarea>
                          </div>

                          <div class="form-group">
                            <input type="submit" name="addTask" class="btn btn-info btn-block btn-flat" value="Add new task">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                  <?php
                }
                else if($do == 'Store'){

                  if(isset($_POST['addTask'])){

                    $task_title    = $_POST['task_title'];
                    $description   = $_POST['description'];
                    $daterange     = $_POST['daterange'];
                    $user_id       = $_POST['user_id'];
                    $status        = $_POST['status'];
                    $note          = $_POST['note'];

                    $sql = "INSERT INTO todo (user_id, task_title, description, deadline, status, note, created_at) VALUES ('$user_id','$task_title','$description','$daterange','$status','$note',now())";

                    $addTask = mysqli_query($db, $sql);
                    
                    if($addTask){
                      header("Location: task.php?do=Manage");
                    }
                    else{
                      die("Mysqli Query Failed. " . mysqli_error($db));
                    }
                  }

                }
                else if($do == 'Edit'){

                }
                else if($do == 'Update'){

                }
                else if($do == 'Delete'){

                }
                
                ?>

              </div>
          </div>
        <!-- Info boxes -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
 
<?php
   include "inc/footer.php";
?>