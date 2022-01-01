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
            $do = (isset($_GET['do'])) ? $_GET['dog'] : 'Manage';

             if($do == 'Manage'){
                 echo "This is our all employee page";
             }
             else if($do == 'Add'){
                 echo "This is our add user HTML page";
             }
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